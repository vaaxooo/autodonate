<?php

namespace App\Http\Services\Auth;

use App\Mail\Logger;
use App\Models\ActivityLogs;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ServiceLogin {

    /**
     * @param $params
     * @param $browser
     * @param $user_ip
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    protected $browser, $user_ip;

    public function handle($params, $browser, $user_ip) {
        $this->browser = $browser;
        $this->user_ip = $user_ip;
        $req = Validator::make($params, [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if ($req->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $req->errors()->toJson()
            ], 200);
        }
        if (!auth()->attempt($req->validated())) {
            return response()->json([
                "status" => false,
                "errors" => json_encode(['Auth error' => [__('E-mail or password is incorrect!')]])
            ], 200);
        }

        $user = User::where('email', $params['email'])->first();
        if($user->twofactor) {
            $this->twoFactorGenerateCode($user);
            session()->put('2factor', $user->email);
            return response()->json([
                "status" => true,
                "redirect" => route('account.auth.login.two_factor')
            ]);
        } else {
            $this->auth($user);
            return response()->json([
                "status" => true,
                "redirect" => route('dashboard')
            ]);
        }
    }

    /**
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function twoFactorGenerateCode($user) {
        if($user->twofactorCode && $user->twofactorCodeTime) {
            $twofactorCodeTime = new Carbon($user->twofactorCodeTime);
            $curretTime = new Carbon(date('Y-m-d H:i:s'));
            $diff = $curretTime->diff($twofactorCodeTime);
            if($diff->i == 0) {
                return response()->json([
                    "status" => false,
                    "message" => json_encode(['Auth error' => [__('Please wait a moment before submitting a new code.')]])
                ], 200);
            }
        }
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $code = substr(str_shuffle($permitted_chars), 0, 6);
        User::where('id', $user->id)->update(['twofactorCode' => $code, 'twofactorCodeTime' => date('Y-m-d H:i:s')]);
        Mail::to($user->email)->send(new Logger('layouts.mailer.logger', [
            'name' => $user->fullname ? $user->fullname : $user->email,
            'description' => __('Your confirmation code: :code. Please do not give it to anyone else.', ['code' => $code])
        ]));
        return response()->json([
            "status" => true,
            "redirect" => null,
            "message" => __('The new verification code was sent to the email address')
        ]);
    }

    /**
     * @param $email
     * @param $params
     * @param $browser
     * @param $user_ip
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function twoFactorCheck($email, $params, $browser, $user_ip) {
        $this->browser = $browser;
        $this->user_ip = $user_ip;
        $req = Validator::make($params, [
            'twofactorCode' => 'required|string',
        ]);
        if ($req->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $req->errors()->toJson()
            ], 200);
        }
        $query = User::where('email', $email);
        $user = $query->first();
        if(!$user || $user->twofactorCode !== $params['twofactorCode']) {
            return response()->json([
                "status" => false,
                "errors" => json_encode(['Auth error' => [__('Verification code is incorrect')]])
            ], 200);
        }

        $twofactorCodeTime = new Carbon($user->twofactorCodeTime);
        $curretTime = new Carbon(date('Y-m-d H:i:s'));
        $diff = $curretTime->diff($twofactorCodeTime);
        if($diff->i > 2) {
            return response()->json([
                "status" => false,
                "errors" => json_encode(['Auth error' => [__('The specified verification code is invalid')]])
            ], 200);
        }

        $query->update(['twofactorCode' => null, 'twofactorCodeTime' => null]);
        session()->forget('2factor');
        $this->auth($user);
        return response()->json([
            "status" => true,
            "redirect" => route('dashboard')
        ]);
    }

    /**
     * @param $user
     * @return bool
     * @throws \Exception
     */
    public function auth($user) {
        session()->regenerate();
        Auth::login($user);
        if($user->logs) {
            $latestLog = ActivityLogs::where('user_id', $user->id)->where('action', 'auth')->orderBy('id', 'desc')->first();
            if(empty($latestLog)){
                return false;
            }
            $latestLogTime = new Carbon($latestLog->created_at);
            $curretTime = new Carbon(date('Y-m-d H:i:s'));
            $diff = $curretTime->diff($latestLogTime);
            if($diff->h > 3 || ($latestLog->browser != $this->browser || $latestLog->user_ip != $this->user_ip)) {
                if($user->smtp_new_browser){
                    Mail::to($user->email)->send(new Logger('layouts.mailer.logger', [
                        'name' => Auth::user()->getNameOrEmail(),
                        'description' => __('Your account is logged in: IP - :ip, Browser - :browser
If it\'s not you, change your password!', ['ip' => $this->user_ip, 'browser' => $this->browser])
                    ]));
                }
                ActivityLogs::create([
                    'user_id' => $user->id,
                    'action' => 'auth',
                    'user_ip' => $this->user_ip,
                    'browser' => $this->browser,
                    'status' => 'success'
                ]);
            }
        }
    }


}
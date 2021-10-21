<?php

namespace App\Http\Services\Auth;

use App\Mail\Logger;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ServiceRecovery {

    /**
     * @param $params
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle($params) {
        $req = Validator::make($params, [
            'email' => 'required|string|email|max:100',
        ]);

        if($req->fails()){
            return response()->json([
                "status" => false,
                "errors" => $req->errors()->toJson()
            ], 200);
        }

        try {

            $query = User::where('email', $params['email']);
            $user = $query->first();
            if(!$user) {
                return response()->json([
                    "status" => false,
                    "errors" => json_encode(['Auth error' => [__('User is not found')]])
                ], 200);
            }

            $recoveryCode = md5(uniqid(rand(), true));
            $query->update([
                'recoveryCode' => $recoveryCode
            ]);
            Mail::to($params['email'])->send(new Logger('layouts.mailer.logger', [
                'name' => $user->fullname ? $user->fullname : $user->email,
                'description' => __('Your link to reset your password: :link. If you haven\'t, just delete this message',
                    ['link' => route('account.auth.recovery.password', ['link' => $recoveryCode, 'id' => $user->id])])
            ]));

        } catch (ValidationException $e) {
            return response()->json(["message" => "Oops.. Something went wrong!"], 200);
        }

        return response()->json([
            "status" => true,
            "redirect" => null,
            "message" => __('The password recovery link was sent to your email')
        ]);
    }

    /**
     * @param $user_id
     * @param $params
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword($user_id, $params) {
        $req = Validator::make($params, [
            'new_password' => 'required|string|min:8|max:30',
            'repeat_password' => 'required|string|min:8|max:30',
        ]);
        if ($req->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $req->errors()->toJson()
            ], 200);
        }
        if($params['new_password'] !== $params['repeat_password']){
            return response()->json([
                "status" => false,
                "errors" => json_encode(['Auth error' => [__('The specified passwords do not match')]])
            ], 200);
        }
        User::where('id', $user_id)->update([
            'password' => Hash::make($params['new_password']),
            'recoveryCode' => null
        ]);
        Notification::create([
            'user_id' => $user_id,
            'title' => __('Password changed'),
            'description' => __('Your password has been successfully changed')
        ]);
        return response()->json([
            "status" => true,
            "redirect" => route('account.auth.login')
        ]);
    }

}

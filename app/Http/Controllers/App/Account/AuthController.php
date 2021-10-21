<?php

namespace App\Http\Controllers\App\Account;

use App\Http\Controllers\Controller;
use App\Http\Services\Auth\ServiceLogin;
use App\Http\Services\Auth\ServiceRegister;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function login(Request $request) {
        if($request->isMethod('post')) {
            $browser = $request->header('User-Agent');
            $user_ip = $request->ip();
            try {
                return (new \App\Http\Services\Auth\ServiceLogin)->handle($request->all(), $browser, $user_ip);
            } catch (ValidationException $e) {}
        }
        return view('pages.account.auth.login');
    }

    public function twoFactor(Request $request) {
        if(!session()->exists('2factor')) {
            return redirect()->route('account.auth.login');
        }
        if($request->isMethod('post')) {
            try {
                $browser = get_browser( $request->header('User-Agent') , true)['browser'];
                $user_ip = $request->ip();
                return (new \App\Http\Services\Auth\ServiceLogin)->twoFactorCheck(session()->get('2factor'),
                    $request->all(), $browser, $user_ip);
            } catch (\Exception $e) {}
        }
        return view('pages.account.auth.two_factor');
    }

    public function twoFactorRefreshCode() {
        if(session()->exists('2factor')) {
            try {
                return (new \App\Http\Services\Auth\ServiceLogin)->twoFactorGenerateCode(Auth::user());
            } catch (\Exception $e) {}
        }
    }

    public function register(Request $request) {
        if($request->isMethod('post')) {
            return (new \App\Http\Services\Auth\ServiceRegister)->handle($request->all());
        }
        return view('pages.account.auth.register');
    }

    public function recovery(Request $request) {
        if($request->isMethod('post')) {
            return (new \App\Http\Services\Auth\ServiceRecovery)->handle($request->all());
        }
        return view('pages.account.auth.recovery');
    }

    public function recoveryPassword(Request $request, $id, $link) {
        $user = User::where('id', $id)->where('recoveryCode', $link)->first();
        if(!$user) {
            return redirect()->route('account.auth.login');
        }
        if($request->isMethod('post')) {
            return (new \App\Http\Services\Auth\ServiceRecovery)->changePassword($id, $request->all());
        }
        return view('pages.account.auth.recovery_password', ['link' => $link, 'id' => $id]);
    }

    public function logout() {
        auth()->logout();
        return redirect('/account/login');
    }

}

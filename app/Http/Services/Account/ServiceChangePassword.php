<?php

namespace App\Http\Services\Account;

use App\Mail\Logger;
use App\Models\ActivityLogs;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ServiceChangePassword {

    public function handle($params) {
        $req = Validator::make($params, [
            'new_password' => 'required|string|min:8|max:30',
            'repeat_password' => 'required|string|min:8|max:30',
            'current_password' => 'required|string|min:8|max:30'
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

        if(Hash::check($params['current_password'], Auth::user()->password)) {
            Auth::user()->update(['password' => Hash::make($params['new_password'])]);

            if(Auth::user()->smtp_unusual_activity){
                Mail::to(Auth::user()->email)->send(new Logger('layouts.mailer.logger', [
                    'name' => Auth::user()->getNameOrEmail(),
                    'description' => __('Your account password has been changed! If you haven\'t, go to - :url', ['url' => route('account.auth.recovery')])
                ]));
            }
            Notification::create([
                'user_id' => Auth::user()->id,
                'title' => 'Password changed',
                'description' => 'Your password has been successfully changed'
            ]);
            return response()->json([
                "status" => true,
                "redirect" => route('account.auth.logout')
            ]);
        }

        return response()->json([
            "status" => false,
            "errors" => json_encode(['Auth error' => [__('Current password is incorrect')]])
        ], 200);

    }

}
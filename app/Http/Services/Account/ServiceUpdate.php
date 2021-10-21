<?php

namespace App\Http\Services\Account;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ServiceUpdate {

    public function handle($params) {
        Auth::user()->update($params);
        return response()->json([
            "status" => true,
            "redirect" => route('account.details')
        ]);
    }

}
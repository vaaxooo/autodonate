<?php

namespace App\Http\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ServiceRegister {

    public function handle($params) {
        $req = Validator::make($params, [
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|max:30',
            'agreement' =>'accepted'
        ]);

        if($req->fails()){
            return response()->json([
                "status" => false,
                "errors" => $req->errors()->toJson()
                ], 200);
        }

        try {
            $user = User::create(array_merge(
                $req->validated(),
                ['password' => bcrypt($params['password'])]
            ));
            Auth::login($user);
        } catch (ValidationException $e) {
            response()->json([
                "status" => false,
                "errors" => $req->errors()->toJson()
            ], 200);
            return response()->json(["message" => "Oops.. Something went wrong!"], 200);
        }

        return response()->json([
            "status" => true,
            "redirect" => route('dashboard')
        ]);
    }

}

<?php

namespace App\Http\Services\Shop;

use App\Models\Shop;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ServiceCreate {

    public function handle($params) {
        $req = Validator::make($params, [
            'name' => 'required|string|max:40',
            'domain' => 'required|string|max:20|unique:shops',
            'ip' => 'required|ip',
            'port' => 'required|integer|min:5',
            'game' => 'required'
        ]);
        if ($req->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $req->errors()->toJson()
            ], 200);
        }

        try {
            if(Shop::where('ip', $params['ip'])->where('port', $params['port'])->count() > 0) {
                return response()->json([
                    "status" => false,
                    "errors" => json_encode(['Auth error' => ['The shop for this server has already been created']])
                ], 200);
            }
            $shop = Shop::create([
                'name' => $params['name'],
                'domain' => $params['domain'],
                'ip' => $params['ip'],
                'port' => $params['port'],
                'game' => $params['game'],
                'user_id' => auth()->user()->id
            ]);
            return response()->json([
                "status" => true,
                "redirect" => route('shop.edit', ['shop' => $shop->id])
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                "status" => false,
                "errors" => json_encode(['Auth error' => ['Oops! Something went wrong']])
            ], 200);
        }

    }

}
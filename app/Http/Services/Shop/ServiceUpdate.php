<?php

namespace App\Http\Services\Shop;

use App\Models\Shop;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ServiceUpdate {

    public function handle($params, $shop) {
        $req = Validator::make($params, [
            'name' => 'required|string|max:40',
            'domain' => 'required|string|max:20',
            'ip' => 'required|ip',
            'port' => 'required|integer|min:5',
            'game' => 'required',
            'rcon_password' => 'required|string'
        ]);
        if ($req->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $req->errors()->toJson()
            ], 200);
        }

        try {

            if($shop->domain == $params['domain'] || Shop::where('domain', $params['domain'])->count() == 0) {
                if(Shop::where('ip', $params['ip'])->where('port', $params['port'])->where('id', '!=', [$shop->id])->count() > 0) {
                    return response()->json([
                        "status" => false,
                        "errors" => json_encode(['Auth error' => ['The shop for this server has already been created']])
                    ], 200);
                }

                Shop::where('id', $shop->id)->where('user_id', auth()->user()->id)->update($req->validated());
                return response()->json([
                    "status" => true,
                    "message" => __('Information has been successfully updated')
                ]);
            }

            return response()->json([
                "status" => false,
                "errors" => json_encode(['Auth error' => [__('Sorry, the specified domain is already taken')]])
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                "status" => false,
                "errors" => json_encode(['Auth error' => ['Oops! Something went wrong']])
            ], 200);
        }

    }

}
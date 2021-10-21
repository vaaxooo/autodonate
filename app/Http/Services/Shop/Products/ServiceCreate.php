<?php


namespace App\Http\Services\Shop\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ServiceCreate
{

    public function handle($shop, $params)
    {
        $req = Validator::make($params, [
            'name' => 'required|string|max:40',
            'description' => 'required|string|max:5000',
            'price' => 'required|integer',
            'category_id' => 'integer',
            'issuance_command' => 'required|string',
            'image' => 'file|max:3000|mimes:jpg,jpeg,png'
        ]);

        if ($req->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $req->errors()->toJson()
            ], 200);
        }

        try {
            $imageName = isset($params['image'])
                ? (new \App\Http\Services\Shop\ServiceImageUpload)->uploadProductImage($params['image'])
                : 'assets/images/product_default_image.svg';

            Product::create([
                'shop_id' => $shop->id,
                'category_id' => $params['category_id'] > 0 ? $params['category_id'] : null,
                'name' => $params['name'],
                'description' => $params['description'],
                'image' => $imageName,
                'issuance_command' => $params['issuance_command'],
                'withdraw_command' => $params['withdraw_command'],
                'withdraw_command_timeout' => $params['withdraw_command_timeout'],
                'price' => $params['price']
            ]);
            return response()->json([
                "status" => true,
                "redirect" => route('shop.items', ['shop' => $shop->id])
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                "status" => false,
                "errors" => json_encode(['Auth error' => ['Oops! Something went wrong']])
            ], 200);
        }

    }

}
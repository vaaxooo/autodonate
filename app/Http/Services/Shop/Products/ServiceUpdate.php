<?php


namespace App\Http\Services\Shop\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ServiceUpdate
{

    public function handle($shop, $product, $params)
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


            if(isset($params['image_delete']) && $params['image_delete'] == "true") {
                $product->update(['image' => "assets/images/product_default_image.svg"]);
            }

            if (isset($params['image'])) {
                $imageName = (new \App\Http\Services\Shop\ServiceImageUpload)->changeProductImage($product->image, $params['image']);
                $product->update(['image' => $imageName]);
            }

            Product::where('id', $product->id)->update([
                'shop_id' => $shop->id,
                'category_id' => $params['category_id'] > 0 ? $params['category_id'] : null,
                'name' => $params['name'],
                'description' => $params['description'],
                'issuance_command' => $params['issuance_command'],
                'withdraw_command' => $params['withdraw_command'] ? $params['withdraw_command'] : null,
                'withdraw_command_timeout' => $params['withdraw_command_timeout'] ? $params['withdraw_command_timeout'] : null,
                'price' => $params['price'],
                'position' => $params['position'] ? $params['position'] : 0,
                'active' => isset($params['active']) ? 1 : 0
            ]);


            return response()->json([
                "status" => true,
                "redirect" => route('shop.items.edit', ['shop' => $shop->id, 'item' => $product->id])
            ]);
        } catch (\Exception $exception) {
            dd($exception);
            return response()->json([
                "status" => false,
                "errors" => json_encode(['Auth error' => ['Oops! Something went wrong']])
            ], 200);
        }

    }

}
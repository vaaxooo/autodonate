<?php


namespace App\Http\Services\Shop\Products\Categories;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class ServiceCreate
{

    public function handle($shop, $params)
    {
        $req = Validator::make($params, [
            'name' => 'required|string|max:40',
            'position' => 'integer',
        ]);

        if ($req->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $req->errors()->toJson()
            ], 200);
        }

        try {
            Category::create([
                'shop_id' => $shop->id,
                'name' => $params['name'],
                'position' => $params['position'] ? $params['position'] : 0,
            ]);
            return response()->json([
                "status" => true,
                "redirect" => route('shop.items.categories', ['shop' => $shop->id])
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                "status" => false,
                "errors" => json_encode(['Auth error' => ['Oops! Something went wrong']])
            ], 200);
        }

    }

}
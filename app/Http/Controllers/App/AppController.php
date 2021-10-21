<?php

namespace App\Http\Controllers\App;

use App\Models\Shop;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppController extends Controller
{
    public function dashboard()
    {
        return view('pages.index');
    }

    public function languageChange(Request $request, $locale)
    {
        if (!in_array($locale, ['en', 'ru'])) {
            abort(400);
        }
        $request->session()->put('locale', $locale);
        App::setLocale($locale);
        return back();
    }

    public function shop($shop)
    {
        $shop = Shop::where('domain', $shop)->first();

        if(!$shop) {
            abort(404);
        }

        $categories = $shop->categories()->orderBy('position', 'desc')->get();
        $products = $shop->products()->where('active', true)->orderBy('position', 'desc')->get();

        return view('shop.default', ['shop' => $shop, 'categories' => $categories, 'products' => $products]);
    }

    public function format(Money $money)
    {
        // TODO: Implement format() method.
    }
}

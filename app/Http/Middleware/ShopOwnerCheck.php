<?php

namespace App\Http\Middleware;

use App\Models\Shop;
use Closure;
use Illuminate\Http\Request;

class ShopOwnerCheck
{
    /**
     * Handle an incoming request.
     *
     * @param Shop $shop
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $shop = $request->shop;
        if(!$shop || $shop['user_id'] != auth()->user()->id) {
            return redirect()->route('shop.index');
        }
        return $next($request);
    }
}

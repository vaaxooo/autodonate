<?php

namespace App\Http\Controllers\App\Shop;

use App\Http\Controllers\Controller;
use App\Http\Services\Shop\Products\ServiceCreate;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Shop $shop
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Shop $shop)
    {
        $items = $shop->products()->orderBy('id', 'desc')->paginate(10);
        return view('pages.shop.control.products.index', ['shop' => $shop, 'items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Shop $shop
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Shop $shop)
    {
        $categories = $shop->categories()->get();
        return view('pages.shop.control.products.create', ['shop' => $shop, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Shop $shop
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Shop $shop, Request $request)
    {
        return (new \App\Http\Services\Shop\Products\ServiceCreate)->handle($shop, $request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Shop $shop
     * @param Product $item
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Shop $shop, Product $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Shop $shop
     * @param Product $item
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Shop $shop, Product $item)
    {
        $categories = $shop->categories()->get();
        return view('pages.shop.control.products.edit', ['shop' => $shop, 'item' => $item, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Shop $shop
     * @param Product $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Shop $shop, Product $item)
    {
        return (new \App\Http\Services\Shop\Products\ServiceUpdate)->handle($shop, $item, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Shop $shop
     * @param Product $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Shop $shop, Product $item)
    {
        $item->delete();
        return back();
    }
}

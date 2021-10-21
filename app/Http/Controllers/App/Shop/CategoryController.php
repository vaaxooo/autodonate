<?php

namespace App\Http\Controllers\App\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Shop $shop
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Shop $shop)
    {
        $categories = $shop->categories()->orderBy('id', 'desc')->paginate(10);
        return view('pages.shop.control.products.categories.index', ['shop' => $shop, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Shop $shop
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Shop $shop)
    {
        return view('pages.shop.control.products.categories.create', ['shop' => $shop]);
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
        return (new \App\Http\Services\Shop\Products\Categories\ServiceCreate)->handle($shop, $request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Shop $shop
     * @param Category $category
     * @return void
     */
    public function show(Shop $shop, Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Shop $shop
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Shop $shop, Category $category)
    {
        return view('pages.shop.control.products.categories.edit', ['shop' => $shop, 'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Shop $shop
     * @param Product $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Shop $shop, Category $category)
    {
        return (new \App\Http\Services\Shop\Products\Categories\ServiceUpdate)->handle($shop, $category, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Shop $shop
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Shop $shop, Category $category)
    {
        $shop->products()->where('category_id', $category->id)->update([
            'category_id' => null
        ]);
        $category->delete();
        return back();
    }
}

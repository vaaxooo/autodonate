<?php

namespace App\Http\Controllers\App\Shop;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $shops = Auth::user()->shops()->orderBy('id', 'desc')->paginate(10);
        return view('pages.shop.index', ['shops' => $shops]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $games = Game::get();
        return view('pages.shop.create', ['games' => $games]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        return (new \App\Http\Services\Shop\ServiceCreate)->handle($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Shop $shop
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Shop $shop)
    {
        return view('pages.shop.control.index', ['shop' => $shop]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Shop $shop
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Shop $shop)
    {
        $games = Game::get();
        return view('pages.shop.control.edit', ['shop' => $shop, 'games' => $games]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        return (new \App\Http\Services\Shop\ServiceUpdate)->handle($request->all(), $shop);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        //
    }


    public function purchases(Shop $shop)
    {
        return view('pages.shop.control.purchases', ['shop' => $shop]);
    }

}

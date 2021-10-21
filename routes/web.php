<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::group(['middleware' => ['auth', '2factor']], function () {
        /**
         * ACCOUNT ROUTES
         */
        Route::get('/', 'App\Http\Controllers\App\AppController@dashboard')->name('dashboard');

        Route::group(['prefix' => 'account'], function () {
            Route::get('/details',
                'App\Http\Controllers\App\Account\AccountController@details')->name('account.details');
            Route::put('/details',
                'App\Http\Controllers\App\Account\AccountController@details')->name('account.details');
            Route::get('/billing',
                'App\Http\Controllers\App\Account\AccountController@billing')->name('account.billing');
            Route::get('/notifications',
                'App\Http\Controllers\App\Account\AccountController@notifications')->name('account.notifications');
            Route::get('/activity',
                'App\Http\Controllers\App\Account\AccountController@activity')->name('account.activity');
            Route::get('/security',
                'App\Http\Controllers\App\Account\AccountController@security')->name('account.security');
            Route::post('/security',
                'App\Http\Controllers\App\Account\AccountController@security')->name('account.security');
            Route::post('/security/change_password',
                'App\Http\Controllers\App\Account\AccountController@changePassword')->name('account.security.change_password');
        });

        /**
         * TICKETS ROUTES
         */
        Route::group(['prefix' => 'tickets'], function () {
            Route::get('/index',
                'App\Http\Controllers\App\Tickets\TicketController@index')->name('tickets.index');
            Route::get('/{id}/show',
                'App\Http\Controllers\App\Tickets\TicketController@show')->name('tickets.show');
            Route::get('/{id}/close',
                'App\Http\Controllers\App\Tickets\TicketController@close')->name('tickets.close');
            Route::post('/{id}/send-message',
                'App\Http\Controllers\App\Tickets\TicketController@sendMessage')->name('tickets.send_message');
            Route::get('/create',
                'App\Http\Controllers\App\Tickets\TicketController@create')->name('tickets.create');
            Route::post('/create',
                'App\Http\Controllers\App\Tickets\TicketController@create')->name('tickets.create');
        });


        Route::group(['middleware' => ['ShopOwnerCheck']], function () {
            /**
             * SHOP ROUTES
             */
            Route::resource('shop', 'App\Http\Controllers\App\Shop\ShopController');
            Route::get('/shop', 'App\Http\Controllers\App\Shop\ShopController@index')->name('shop.index')->withoutMiddleware('ShopOwnerCheck');
            Route::get('/shop/create', 'App\Http\Controllers\App\Shop\ShopController@create')->name('shop.create')->withoutMiddleware('ShopOwnerCheck');

            Route::group(['prefix' => 'shop'], function () {
                Route::get('/{shop}/items',
                    'App\Http\Controllers\App\Shop\ProductController@index')->name('shop.items');
                Route::get('/{shop}/items/create',
                    'App\Http\Controllers\App\Shop\ProductController@create')->name('shop.items.create');
                Route::post('/{shop}/items/create',
                    'App\Http\Controllers\App\Shop\ProductController@store')->name('shop.items.create');
                Route::get('/{shop}/items/{item}/edit',
                    'App\Http\Controllers\App\Shop\ProductController@edit')->name('shop.items.edit');
                Route::post('/{shop}/items/{item}/edit',
                    'App\Http\Controllers\App\Shop\ProductController@update')->name('shop.items.edit');
                Route::get('/{shop}/items/{item}/delete',
                    'App\Http\Controllers\App\Shop\ProductController@destroy')->name('shop.items.delete');
                Route::get('/{shop}/items/{item}',
                    'App\Http\Controllers\App\Shop\ProductController@show')->name('shop.items.show');
                Route::get('/{shop}/purchases',
                    'App\Http\Controllers\App\Shop\ShopController@purchases')->name('shop.purchases');

                /**
                 * CATEGORIES ROUTES
                 */
                Route::get('/{shop}/items/categories/list',
                    'App\Http\Controllers\App\Shop\CategoryController@index')->name('shop.items.categories');
                Route::get('/{shop}/items/categories/create',
                    'App\Http\Controllers\App\Shop\CategoryController@create')->name('shop.items.categories.create');
                Route::post('/{shop}/items/categories/create',
                    'App\Http\Controllers\App\Shop\CategoryController@store')->name('shop.items.categories.create');
                Route::get('/{shop}/items/categories/{category}/edit',
                    'App\Http\Controllers\App\Shop\CategoryController@edit')->name('shop.items.categories.edit');
                Route::post('/{shop}/items/categories/{category}/edit',
                    'App\Http\Controllers\App\Shop\CategoryController@update')->name('shop.items.categories.edit');
                Route::get('/{shop}/items/categories/{category}/delete',
                    'App\Http\Controllers\App\Shop\CategoryController@destroy')->name('shop.items.categories.delete');
            });
        });

    });

    /*
     * AUTH ROUTES
     */
    Route::group(['prefix' => 'account'], function () {
        Route::get('/login',
            'App\Http\Controllers\App\Account\AuthController@login')->name('account.auth.login');
        Route::post('/login',
            'App\Http\Controllers\App\Account\AuthController@login')->name('account.auth.login');
        Route::get('/login/two-factor',
            'App\Http\Controllers\App\Account\AuthController@twoFactor')->name('account.auth.login.two_factor');
        Route::post('/login/two-factor',
            'App\Http\Controllers\App\Account\AuthController@twoFactor')->name('account.auth.login.two_factor');
        Route::get('/login/two-factor/refresh',
            'App\Http\Controllers\App\Account\AuthController@twoFactorRefreshCode')->name('account.auth.login.two_factor.refresh');
        Route::get('/logout',
            'App\Http\Controllers\App\Account\AuthController@logout')->name('account.auth.logout');
        Route::get('/register',
            'App\Http\Controllers\App\Account\AuthController@register')->name('account.auth.register');
        Route::post('/register',
            'App\Http\Controllers\App\Account\AuthController@register')->name('account.auth.register');
        Route::get('/recovery',
            'App\Http\Controllers\App\Account\AuthController@recovery')->name('account.auth.recovery');
        Route::post('/recovery',
            'App\Http\Controllers\App\Account\AuthController@recovery')->name('account.auth.recovery');
        Route::get('/recovery/password/{id}/{link}',
            'App\Http\Controllers\App\Account\AuthController@recoveryPassword')->name('account.auth.recovery.password');
        Route::post('/recovery/password/{id}/{link}',
            'App\Http\Controllers\App\Account\AuthController@recoveryPassword')->name('account.auth.recovery.password');
    });
});

/**
 * MULTI-LANGUAGE ROUTE
 */
Route::get('/language-change/{locale}',
    'App\Http\Controllers\App\AppController@languageChange')->name('language.change');

Route::get('/{shop?}', 'App\Http\Controllers\App\AppController@shop');
Route::domain("{shop}.".env('APP_DOMAIN', 'localhost'))->group(function () {
    Route::get('/', 'App\Http\Controllers\App\AppController@shop');
});
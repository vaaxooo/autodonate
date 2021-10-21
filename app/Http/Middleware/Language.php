<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Closure;
use Illuminate\Http\Request;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('locale') and in_array($request->session()->get('locale'), ['en', 'ru'])) {
            App::setLocale($request->session()->get('locale'));
            setlocale(LC_ALL, 'ru_RU.utf8');
            Carbon::setLocale($request->session()->get('locale'));
        } else {
            App::setLocale(config('app.fallback_locale'));
        }
        return $next($request);
    }

}

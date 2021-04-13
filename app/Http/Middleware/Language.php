<?php

namespace App\Http\Middleware;

use Closure;
use App;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = app()->getLocale();
        $browserLocale = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        if (in_array($browserLocale, locales(true))) {
            app()->setLocale($browserLocale);
            return $next($request);
        } else {
            return $next($request);
        }

    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class HttpsProtocol
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
        if (env('APP_ENV') != "local") {
            if ($_SERVER['HTTP_X_FORWARDED_PROTO'] == "http") {
                return redirect()->secure($request->getRequestUri(), 302);
            }
            if (!strstr($request->header('host'), 'www.')) {
                $host = "www." . $request->header('host');
                $request->headers->set('host', $host);
                return redirect()->secure($request->getRequestUri(), 301);
            }
        }

        return $next($request);
    }
}

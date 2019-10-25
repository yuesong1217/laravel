<?php

namespace App\Http\Middleware;

use Closure;

class Api
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        header("Access-Control-Allow-Origin:*");

        header('Access-Control-Allow-Methods:POST');

        header('Access-Control-Allow-Headers:x-requested-with, content-type');
        return $next($request);
    }
}

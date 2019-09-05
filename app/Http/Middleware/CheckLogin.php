<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        $session=request()->session()->get('userinfo');
        if (!$session) {
            return redirect('admin/login');
        }
        return $next($request);
    }
}

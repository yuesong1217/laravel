<?php

namespace App\Http\Middleware;

use Closure;

class Login
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
        $session=request()->session()->get('userhuo');
        if (!$session) {
            return redirect('role/login');
        }
        return $next($request);
    }
}

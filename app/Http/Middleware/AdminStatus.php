<?php

namespace App\Http\Middleware;

use Closure;

class AdminStatus
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
        if(auth()->user()->status != '1' || auth()->user()->role != 'Admin'){
            auth()->logout();
            return redirect('/login')->withInput()->withErrors(['Sorry! Your account status is not active.']);
        }
        return $next($request);
    }
}

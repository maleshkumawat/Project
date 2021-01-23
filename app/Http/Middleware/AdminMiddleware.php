<?php

namespace App\Http\Middleware;

use Closure;
// use Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminMiddleware
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
        if(Auth::check() && Auth::user()->role_id == 2){
    
            return $next($request);
        }
     else {
            return redirect()->route('login');
        }
    }
}

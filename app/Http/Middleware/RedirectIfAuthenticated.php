<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && Auth::user()->role_id == 1) {
            return redirect()->route('SuperAdmin.SuperAdminDashboard');
        }elseif(Auth::guard($guard)->check() && Auth::user()->role_id == 2){
            return redirect()->route('Admin.AdminDashboard');
        }elseif(Auth::guard($guard)->check() && Auth::user()->role_id == 3){
            return redirect()->route('CarService.CarDashboard');
        } elseif (Auth::guard($guard)->check() && Auth::user()->role_id == 4) {
                return redirect()->route('Driver.DriverDashboard');
        }elseif (Auth::guard($guard)->check() && Auth::user()->role_id == 5) {
            return redirect()->route('Passenger.PassengerDashboard');
        }
        else {
            return $next($request);
        }
         
        
    }
}

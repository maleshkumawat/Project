<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Login;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
            protected function redirectTo()
    {
        if (Auth::user()->role_id == 1) {
            return route('SuperAdmin.SuperAdminDashboard');
        } elseif (Auth::user()->role_id == 2) {
            return route('Admin.AdminDashboard');
        } elseif (Auth::user()->role_id == 3) {
            return route('CarService.CarDashboard');
        } elseif(Auth::user()->role_id == 4){
            return route('Driver.DriverDashboard');
        }elseif (Auth::user()->role_id == 5) {
            return route('Passenger.PassengerDashboard');
        }
        return '/login';
    }
        
    
    
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    // public function index(){
    //     $user = Login::all();
    //     return view('auth.login',['user'=>$user]);
    // }
    public  function logout()
    {
      Auth::logout();
      return redirect('login');
    }
    // public function login(){
    //     return view('auth.login');
    // }
}

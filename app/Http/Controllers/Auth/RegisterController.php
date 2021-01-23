<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
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
    protected function validator(array $data)
    {
    //    dd($data);
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'role_id' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required','max:10'],
            'image' => ['nullable'],
            'about' => ['nullable'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     * 
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {   
        return User::create([
            'name' => $data['name'],
            'role_id' => $data['role_id'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            // 'image' => $data['image'],
            // 'about' => $data['about'],
            'password' => Hash::make($data['password']),
        ]);
      
    }
   
  
    
    
       
   
}

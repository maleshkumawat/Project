<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Super\SuperAdminController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Car\CarServiceController;
use App\Http\Controllers\Car\CarServiceProfileController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Driver\DriverController;
use App\Http\Controllers\Driver\DriverProfileController;
use App\Http\Controllers\Passanger\PassangerController;
use App\Http\Controllers\Passanger\PassengerProfileController;
use App\Http\Controllers\Super\SuperAdminProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;


    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 
    Route::group(['as'=>'SuperAdmin.','prefix'=>'SuperAdmin', 'middleware'=>['auth','super']], function(){
        Route::get('SuperAdminDashboard',[SuperAdminController::class,'super'])->middleware('verified')->name('SuperAdminDashboard');
        Route::resource('profile', SuperAdminProfileController::class);
    });

    Route::group(['as'=>'Admin.','prefix' => 'Admin','middleware'=>['auth','admin']], function () {
        Route::get('AdminDashboard',[AdminController::class,'admin'])->middleware('verified')->name('AdminDashboard');
        Route::resource('profile',AdminProfileController::class);
    });

    Route::group(['as'=>'CarService.','prefix' => 'CarService','middleware'=>['auth','car']], function (){
        Route::get('CarDashboard',[CarServiceController::class,'car'])->middleware('verified')->name('CarDashboard');
        Route::resource('profile',CarServiceProfileController::class);
    });

    Route::group(['as'=>'Driver.','prefix' => 'Driver' ,'middleware' => ['auth','driver']], function() {
        Route::get('DriverDashboard' ,[DriverController::class, 'driver'])->middleware('verified')->name('DriverDashboard'); 
        Route::resource('profile',DriverProfileController::class);
    });


    Route::group(['as' =>'Passenger.' ,'prifix' => 'Passenger','middleware' => ['auth','passenger']] ,function(){
        Route::get('PassengerDashboard', [PassangerController::class,'passenger'])->middleware('verified')->name('PassengerDashboard');
        Route::resource('profile',PassengerProfileController::class);
    });

    Route::get('/forgot-password', function(){
        return view('auth.forgot-password');
    })->middleware('guest')->name('password-request');

    Route::get('/email/verify', function(){
        return view('auth.verify');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function(EmailVerificationRequest $request){
        $request->fulfill();
        return redirect('/login');
        })->middleware(['auth','signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function(Request $request){
        $request->user()->sendEmailVerificationNotification();
        return back()->with('messege','verification link send!!');
        })->middleware(['auth','throttle:6,1'])->name('verification.resend');

        
    

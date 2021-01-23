<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarServiceController extends Controller
{
    public function car(){
        return view('CarService.dashboard');
    }
}

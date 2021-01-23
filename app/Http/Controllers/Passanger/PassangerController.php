<?php

namespace App\Http\Controllers\Passanger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PassangerController extends Controller
{
    public function passenger(){
        return view('passenger.passengerdashboard');
    }
}

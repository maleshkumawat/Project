<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
            public function index(){
                $Pro = User::get();
                // dd($Pro);
               return view('SuperAdmin.profile',compact('Pro'));
            }

        public function edit($id){
            $pEdit = User::find($id);
            // dd($pEdit);
            if($pEdit){
                $Pro = User::get();
                return view('SuperAdmin.profile',compact('pEdit','Pro'));
            }
        }
       
    }

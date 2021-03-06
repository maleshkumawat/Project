<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = User::get();
        // dd($Super);
        return view('Admin.profile',compact('admin'));
        // return 'malesh';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.profile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $SuperStore  = new User;
                // dd($SuperStore);
        
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/slider/', $filename);
            $SuperStore->image = $filename;
        } else {
            return $request;
            $SuperStore->image = '';
        }
        $SuperStore->email =$request->email;

        $SuperStore->name =$request->name;
        $SuperStore->phone =$request->phone;
        $SuperStore->password =$request->password;
        $SuperStore->address =$request->address;
        $SuperStore->city =$request->city;
        $SuperStore->country =$request->country;
        $SuperStore->postalcode =$request->postalcode;
        $SuperStore->about =$request->about;
        dd($SuperStore);
        try{
            $SuperStore->save();
            return \Redirect::back()->withInput(['success' => 'profile updated!']);
        }catch(\Throwable $th){
            return \Redirect::back()->withInput(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $AdminEdit = User::find($id);
        // dd($SuperEdit);
        if ($AdminEdit) 
            
        $admin = User::get();
        // dd($Super);
        return view('Admin.profile',compact('AdminEdit','admin'));
        // return 'super profile';
        // return view('SuperAdmin.profile');
        // return view('SuperAdmin.profile');
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        User::where('id',$id)->update([
            'name'     => $request['name'],
            'email'    => $request['email'],
            'phone'    => $request['phone'],
            'image'    => $request['image'],
            'password' => $request['password'],
            'address'  => $request['address'],
            'country'  => $request['country'],
            'city'     => $request['country'],
            'postalcode' => $request['postalcode'],
            'about'     => $request['about'],
        ]);
        return redirect::back()->with('success','your profile has been updates!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

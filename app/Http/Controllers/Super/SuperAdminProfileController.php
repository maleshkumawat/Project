<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SuperAdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Super = User::get();
        return view('SuperAdmin.profile',compact('Super'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('SuperAdmin.profile');
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
                if ($request->hasfile('image')) {
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension(); 
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/appsetting/', $filename);
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
        $SuperEdit = User::find($id);
        if ($SuperEdit) 
        $Super = User::get();
        return view('SuperAdmin.profile',compact('SuperEdit','Super'));
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:webcustomer');
        auth()->setDefaultDriver('webcustomer');
    }
    public function show(){
        return view('user.auth.changepassword');
    }
    public function change(Request $request){
     $request->validate([
         'password'=>'required|confirmed|min:6',
         'old_password'=>'required'
     ]);
     $customer = auth()->user();
     if(Hash::check($request->old_password, $customer->password)) {
         $customer->password = Hash::make($request->password);
         $customer->update();
         return redirect()->back()->with('success','Password Changed');
     }else{
         return redirect()->back()->with('fail','Incorrect Password');
     }
     return redirect()->back()->with('fail','Something Went Wrong');
    }
}

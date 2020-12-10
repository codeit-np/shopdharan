<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show(){
        return view('admin.auth.changepassword');
    }
    public function change(Request $request){
     $request->validate([
         'password'=>'required|confirmed|min:6',
         'old_password'=>'required'
     ]);
     $user = auth()->user();
     if(Hash::check($request->old_password, $user->password)) {
         $user->password = Hash::make($request->password);
         $user->update();
         return redirect()->back()->with('success','Password Changed');
     }else{
         return redirect()->back()->with('fail','Incorrect Password');
     }
     return redirect()->back()->with('fail','Something Went Wrong');
    }
}

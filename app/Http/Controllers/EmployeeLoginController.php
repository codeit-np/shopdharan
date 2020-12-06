<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeLoginController extends Controller
{

    // public function show(){
    //     return view('supplier.login');
    // }
    // public function process(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required',
    //         'password' => 'required'
    //     ]);
        
    //     $credentials = $request->only(['email','password']);
    //     $remember = $request->has('remember')?true:false;
    //     if(auth()->attempt($credentials,$remember)){
    //         return redirect('/supplier');
    //     }
    //     return redirect()->back()->with('fail','Invalid Credentials');
    // }

    public function logout(){
        auth()->logout();
        return redirect('/home');
    }
}

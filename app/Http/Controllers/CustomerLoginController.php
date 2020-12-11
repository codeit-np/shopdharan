<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerLoginController extends Controller
{
    public function __construct()
    {
        auth()->setDefaultDriver('webcustomer');
    }

    public function showlogin(){
        return view('user.auth.login');
    }
    public function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $credentials = $request->only(['email','password']);
        $remember = $request->has('remember')?true:false;
        if(auth()->attempt($credentials,$remember)){
            return redirect()->route('customer.home');
        }
        return redirect()->back()->with('fail','Invalid Credentials');
    }
    public function logout(){
        auth()->logout();
        return redirect()->route('customer.home');
    }
}
 
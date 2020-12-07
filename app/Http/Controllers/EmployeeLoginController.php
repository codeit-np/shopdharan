<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeLoginController extends Controller
{

    public function show(){
        return view('admin.auth.login');
        $this->middleware('guest')->except('logout');
    }
    public function process(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        
        $credentials = $request->only(['email','password']);
        // dd($credentials);
        $remember = $request->has('remember')?true:false;
        if(auth()->attempt($credentials,$remember)){
            return redirect('/home');
        }
        return redirect()->back()->with('fail','Invalid Credentials');
    }

    public function logout(){
        auth()->logout();
        return redirect('/home');
    }
}

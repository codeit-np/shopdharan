<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class SupplierLoginController extends Controller
{
    public function __construct()
    {
        auth()->setDefaultDriver('webvendor');
    }

    public function show(){
        return view('supplier.login');
    }
    public function process(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        
        $credentials = $request->only(['email','password']);
        $remember = $request->has('remember')?true:false;
        if(auth()->attempt($credentials,$remember)){
            return redirect('/supplier');
        }
        return redirect()->back()->with('fail','Invalid Credentials');
    }
}

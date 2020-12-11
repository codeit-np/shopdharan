<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerRegisterController extends Controller
{   
    public function __construct()
    {
        auth()->setDefaultDriver('webcustomer');
    }

    public function showregister(){

        return view('user.auth.register');
    }
    public function register(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required|confirmed|min:6',
            'mobile'=> 'required|numeric'
        ]);
        $remember = $request->has('remember')?true:false;
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->mobile = $request->mobile;
        $customer->password = Hash::make($request->password);
        $customer->save();
        $credentials = $request->only(['email','password']);
        if(auth()->attempt($credentials,$remember)){
            return redirect()->route('customer.home');
        }
        return redirect()->back()->with('fail','failed to signup');
    }
}

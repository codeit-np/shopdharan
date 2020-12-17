<?php

namespace App\Http\Controllers;

use App\Models\UserPasswordReset;
use Illuminate\Http\Request;
use App\Helpers\SendToken;
use Illuminate\Support\Str;

class CustomerForgotPasswordController extends Controller
{
    public function show(){
        return view('user.auth.password.email');
    }
    public function send(Request $request){
        $request->validate([
            'email'=>'required|email'
        ]);
        $password_reset = new UserPasswordReset();
        $password_reset->email = $request->email;
        $password_reset->token = Str::random(6);
        $password_reset->save();
        SendToken::send($password_reset->email,$password_reset->token,route('customer.reset'));
        return redirect()->back()->with('success',"Email Link Sent");
    }
}

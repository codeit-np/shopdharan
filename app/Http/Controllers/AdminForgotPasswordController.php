<?php

namespace App\Http\Controllers;

use App\Models\AdminPasswordReset;
use Illuminate\Http\Request;
use App\Helpers\SendToken;
use Illuminate\Support\Str;

class AdminForgotPasswordController extends Controller
{
    public function show(){

        return view('admin.auth.email');
    }
    public function send(Request $request){
        $request->validate([
            'email'=>'required|email'
        ]);
        $password_reset = new AdminPasswordReset();
        $password_reset->email = $request->email;
        $password_reset->token = Str::random(6);
        $password_reset->save();
        SendToken::send($password_reset->email,$password_reset->token,route('admin.reset'));
        return redirect()->back()->with('success',"Email Link Sent");
    }
}

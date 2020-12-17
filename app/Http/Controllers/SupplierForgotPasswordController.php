<?php

namespace App\Http\Controllers;

use App\Helpers\SendToken;
use App\Models\SupplierPasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SupplierForgotPasswordController extends Controller
{
    public  function show(){
        return view('supplier.auth.email');
    }
    public function send(Request $request){
        $request->validate([
            'email'=>'required|email'
        ]);
        $password_reset = new SupplierPasswordReset();
        $password_reset->email = $request->email;
        $password_reset->token = Str::random(6);
        $password_reset->save();
        SendToken::send($password_reset->email,$password_reset->token,route('supplier.reset'));
        return redirect()->back()->with('success',"Email Link Sent");
    }
}

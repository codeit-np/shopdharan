<?php

namespace App\Http\Controllers;

use App\Models\AdminPasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\PseudoTypes\True_;

class AdminResetPasswordController extends Controller
{
    public function show(Request $request){
        $request->validate([
            'email'=>'required|email',
            'token'=>'required',
        ]);
        $email = $request->email;
        $token = $request->token;
        return view('admin.auth.reset',compact('email','token'));
    }
    public function send(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'confirmed|required'
        ]);
        $reset_password = AdminPasswordReset::where('email',$request->email)->where('token',$request->token)->get()->first();
        if(!$reset_password){
            return redirect()->back()->with('fail','Invalid Token');
        }
        if(strtotime($reset_password->issued_at)<(time()+3600)){
            $reset_password->delete();
            return redirect()->back()->with('fail','Token Expired');
        }
        $user = User::where('email',$request->email)->first();
        $user->password = Hash::make($request->password);
        if(auth()->attempt(['email'=>$request->email,'password'=>$request->password],true)){
            $reset_password->delete();
            return redirect(route('admin.home'));
        }
        return redirect()->back()->with('fail','Something Went Wrong');
    }
}

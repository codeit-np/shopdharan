<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SupplierChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:webvendor');
        auth()->setDefaultDriver('webvendor');
    }
    public function show()
    {
        return view('supplier.auth.changepassword');
    }
    public function change(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
            'old_password' => 'required'
        ]);
        $vendor = auth()->user();
        if (Hash::check($request->old_password, $vendor->password)) {
            $vendor->password = Hash::make($request->password);
            $vendor->update();
            return redirect()->back()->with('success', 'Password Changed');
        } else {
            return redirect()->back()->with('fail', 'Incorrect Password');
        }
        return redirect()->back()->with('fail', 'Something Went Wrong');
    }
}

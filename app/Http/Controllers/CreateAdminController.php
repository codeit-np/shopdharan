<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Faker\Guesser\Name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CreateAdminController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $employee = new User();
        $employee->name = "Root Admin";
        $employee->email = "admin@admin.com";
        $employee->password = Hash::make('password');
        $employee->is_admin = true;
        try{
            $employee->save();
        }catch(Exception $e){
            return redirect()->back();
        }
        return redirect('login');
    }
}

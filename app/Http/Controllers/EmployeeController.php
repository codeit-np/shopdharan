<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = User::all();
        return view('employees.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'is_admin' => 'required'
        ]);
        $user_employee = auth()->user();
        if(!$user_employee->is_admin){
            return redirect()->back()->with('fail',"You're not Allowed To Perform This Task");
        }
        $employee = new User();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->password = $request->password;
        $employee->is_admin = $request->is_admin;
        $employee->save();
        return redirect()->back()->with('success', 'Employee Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_employee = auth()->user();
        if(!$user_employee->is_admin){
            return redirect()->back()->with('fail',"You're not Allowed To Perform This Task");
        }
        $employee = User::find($id);
        if(! $employee){
            return redirect('/employees/create');
        }
        $employees = User::all();
        return view('employees.edit', compact('employee', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'is_admin' => 'required'
        ]);
        $user_employee = auth()->user();
        if(!$user_employee->is_admin){
            return redirect()->back()->with('fail',"You're not Allowed To Perform This Task");
        }
        $employee = User::find($id);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->is_admin = $request->is_admin;
        $employee->update();
        return redirect()->back()->with('success', 'Employee Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_employee = auth()->user();
        if(!$user_employee->is_admin){
            return redirect()->back()->with('fail',"You're not Allowed To Perform This Task");
        }
        $employee = User::find($id);
        $employee->delete();
        return redirect('/employees/create')->with('success', 'Employee Deleted Successfully');
    }
}

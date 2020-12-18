<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
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
        $cities = City::all();
        return view('city.create',compact('cities'));
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
            'city' => 'required'
        ]);
        $employee = auth()->user();
        if(!$employee->is_admin){
            return redirect()->back()->with('fail',"You're not Allowed To Perform This Task");
        }
        $city = new City();
        $city->city = $request->city;
        $city->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::findOrFail($id);
        $cities = City::all();
        return view('city.edit',compact('cities','city'));
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
            'city' => 'required'
        ]);
        $employee = auth()->user();
        if(!$employee->is_admin){
            return redirect()->back()->with('fail',"You're not Allowed To Perform This Task");
        }
        $city = City::findOrFail($id);
        $city->city = $request->city;
        $city->update();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = auth()->user();
        if(!$employee->is_admin){
            return redirect()->back()->with('fail',"You're not Allowed To Perform This Task");
        }
        City::destroy($id);
        return redirect()->route('cities.create');
    }
}

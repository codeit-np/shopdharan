<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\City;
use App\Models\Customer;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:webcustomer');
        auth()->setDefaultDriver('webcustomer');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        $customer = Customer::all()->first();
        $addresses = $customer->addresses;
        $addresses->load('city');
        return view('user.address.index', compact('cities','addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'city_id'=>'required',
            'street'=>'required'
        ]);
        $customer = auth()->user();
        $address = new Address();
        $address->city_id = $request->city_id;
        $address->street = $request->street;
        $address->details = $request->details;
        $address->label = $request->label;
        $address->customer_id = $customer->id;
        $address->save();
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
        $customer = auth()->user();
        $address = Address::find($id);
        if($address->customer_id != $customer->id){
            return redirect()->back();
        }
        $cities = City::all();
        $addresses = $customer->addresses;
        $addresses->load('city');
        return view('user.address.edit', compact('cities','addresses','address'));
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
            'city_id'=>'required',
            'street'=>'required'
        ]);
        $customer = auth()->user();
        $address = Address::find($id);
        if($address->customer_id == $customer->id){
            $address->city_id = $request->city_id;
            $address->street = $request->street;
            $address->details = $request->details;
            $address->label = $request->label;
            $address->update();
        }
        
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
        $customer = auth()->user();
        $address = Address::find($id);
        if($address->customer_id==$customer->id){
            $address->delete();
        }
        return redirect()->route('address.index');
    }
}

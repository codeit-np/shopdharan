<?php

namespace App\Http\Controllers;

use App\Helpers\SavePhoto;
use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;

class SupplierInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::all();
        $vendor = $vendors[0];
        $cities = City::all();
        $categories = Category::all();
        $image = SavePhoto::ImageLink($vendor->image);
        return view('supplier.home',compact('vendor','image','cities','categories'));
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'city_id'=> 'required',
            'category_id'=>'required',
            'email'=>'required|email',
            'open'=>'required'
        ]);
        $vendors = Vendor::all();
        $vendor = $vendors[0];
        $vendor->name = $request->name;
        $vendor->city_id = $request->city_id;    
        $vendor->category_id = $request->category_id;
        $vendor->email = $request->email;
        $vendor->open = $request->open;
        if($request->hasFile('image')){
            $filename = SavePhoto::SaveImage($request->file('image'));
            $vendor->image = $filename;
            $vendor->update();
        }
        $vendor->update();
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
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\SavePhoto;
use App\Models\Category;
use App\Models\City;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        $categories = Category::all();
        $vendors = Vendor::all();
        $vendors->load(['city','category']);
        // $vendorlist = Vendor::all();
        // $vendors = array();
        // foreach($vendorlist as $vendor){
        //     $newvendor = $vendor;
        //     $city = $vendor->city;
        //     $category = $vendor->category;
        //     $newvendor->city = $city->city;
        //     $newvendor->category = $category->category;
        //     array_push($vendors, $newvendor);
        // }
        return view('vendors.create',compact('categories','cities','vendors'));
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
            'name'=>'required',
            'city_id'=> 'required',
            'category_id'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'visible'=>'required',
            'open'=>'required'
        ]);
        $vendor = new Vendor();
        $vendor->name = $request->name;
        $vendor->city_id = $request->city_id;    
        $vendor->category_id = $request->category_id;
        $vendor->email = $request->email;
        $vendor->password = Hash::make($request->password);
        $vendor->visible = $request->visible;
        $vendor->open = $request->open;
        if($request->hasFile('image')){
            $filename = SavePhoto::SaveImage($request->file('image'));
            $vendor->image = $filename;
        }
        $vendor->save();
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
        $vendor = Vendor::find($id);
        $cities = City::all();
        $categories = Category::all();
        $vendors = Vendor::all();
        $vendors->load(['city','category']);
        // $vendorlist = Vendor::all();
        // $vendors = array();
        // foreach($vendorlist as $currentvendor){
        //     $newvendor = $currentvendor;
        //     $city = $currentvendor->city;
        //     $category = $currentvendor->category;
        //     $newvendor->city = $city->city;
        //     $newvendor->category = $category->category;
        //     array_push($vendors, $newvendor);
        // }
        return view('vendors.edit',compact('cities','categories','vendors','vendor'));
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
            'name'=>'required',
            'city_id'=> 'required',
            'category_id'=>'required',
            'email'=>'required|email',
            'visible'=>'required',
            'open'=>'required'
        ]);
        $vendor = Vendor::find($id);
        $vendor->name = $request->name;
        $vendor->city_id = $request->city_id;    
        $vendor->category_id = $request->category_id;
        $vendor->email = $request->email;
        $vendor->visible = $request->visible;
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
        //
        Vendor::destroy($id);
        return redirect('/vendors/create');
    }
}

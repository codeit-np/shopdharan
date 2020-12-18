<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Vendor;
use Illuminate\Http\Request;

class UserVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $categories = Category::all();
        $vendors_query = Vendor::query();
        $vendors_query->where('visible',true);
        if($request->has('category')){
            $vendors_query->where('category_id',$request->category);
        }
        $vendors = $vendors_query->get();
        // if($request->has('category')){
        //     $category = Category::find($request->category);
        //     $vendors = $category->vendors;
        // }else{
        //     $vendors = Vendor::all();
        // }
        $vendors->load('city');
        return view('user.supplier.index', compact('categories','vendors'));
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
        $vendor = Vendor::findOrFail($id);
        $products = $vendor->products;
        $category = $vendor->category;
        $vendors = $category->vendors;
        return view('user.supplier.show', compact('vendor','products','vendors'));
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
    public function update(Request $request, $id)
    {
        //
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
    }
}

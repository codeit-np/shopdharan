<?php

namespace App\Http\Controllers;

use App\Helpers\SavePhoto;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;

class SupplierProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:webvendor');
        auth()->setDefaultDriver('webvendor');
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
        // $products = Product::all();
        $supplier = auth()->user();
        $products= $supplier->products;
        return view('supplier.product.create', compact('products'));
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
            'price'=>'required|min:0',
            'discount'=>'required|min:0',
            'available'=>'required',
        ]);
       
        $supplier = auth()->user();
        $product = new Product();
        $product->vendor_id= $supplier->id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->discount = $request->discount;
        // $product->selling_price = $request->price - $request->discount;
        $product->description = $request->description;
        $product->available = $request->available;
        if($request->hasFile('image')){
            $filename = SavePhoto::SaveImage($request->file('image'));
            $product->image = $filename;
        }
        $product->save();
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
        $vendor = auth()->user();
        $product = Product::find($id);
        if($product->vendor_id != $vendor->id){
            return redirect()->back()->with('fail', "You're not allowed To View That");
        }
        $products = $vendor->products;
        return view('supplier.product.edit',compact('products','product'));
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
            'price'=>'required|min:0',
            'discount'=>'required|min:0',
            'available'=>'required',
        ]);
        $product = Product::find($id);
        $vendor = auth()->user();
        if($product->vendor_id!= $vendor->id){
            return redirect()->back()->with('fail', "You're Not Allowed To Do That");
        }
        $product->name = $request->name;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->description = $request->description;
        $product->available = $request->available;
        if($request->hasFile('image')){
            $filename = SavePhoto::SaveImage($request->file('image'));
            $product->image = $filename;
        }
        $product->update();
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
        $product = Product::find($id);
        $vendor = auth()->user();
        if($product->vendor_id!= $vendor->id){
            return redirect()->back()->with('fail', "You're Not Allowed To Do That");
        }
        $product->delete();
        return redirect('/supplier/products/create');
    }
}

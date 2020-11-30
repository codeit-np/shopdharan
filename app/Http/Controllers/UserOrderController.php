<?php

namespace App\Http\Controllers;

use App\Helpers\CartData;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
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
        $delivery_charge = intval(env('DELIVERY_CHARGE', 50));
        $request->validate([
            'address_id' => 'required'
            ]);
            $customer = Customer::all()->first();
            $data = CartData::getCartData($customer);
            $order = new Order();
            $order->address_id = $request->address_id;
            $order->customer_id = $customer->id;
            $order->charge = $delivery_charge;
            $order->total = $data['total'];
            $order->net_total = $delivery_charge + $data['total'];
            $order->save();
            $cart_items = $data['cart_items'];
            $order_items = array();
            foreach($cart_items as $cart_item){
                $order_item = new OrderDetail();
                $order_item->product_id = $cart_item->product_id;
                $order_item->vendor_id = $cart_item->product->vendor_id;
                $order_item->qty = $cart_item->qty;
                $order_item->amount = $cart_item->product->price - $cart_item->product->discount; 
                array_push($order_items,$order_item);
            }
        $order->items()->saveMany($order_items);
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
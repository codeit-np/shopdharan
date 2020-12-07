<?php

namespace App\Http\Controllers;

use App\Helpers\CartData;
use App\Models\Customer;
use App\Models\Product;
use App\Models\UserCart;
use Illuminate\Http\Request;

class CartController extends Controller
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
        $customer = auth()->user();
        // $cart_items = $customer->cart_items;
        // $cart_items->load('product');
        // $total = 0;
        // $quantity = 0;
        // $addresses = $customer->addresses;
        // $addresses->load('city');
        // foreach ($cart_items as $cart_item) {
        //     $price = $cart_item->product->price - $cart_item->product->discount;
        //     $total += $cart_item->qty * $price;
        //     $quantity += $cart_item->qty;
        // }
        $data = CartData::getCartData($customer);
        $cart_items = $data['cart_items'];
        $total = $data['total'];
        $quantity = $data['quantity'];
        return view('user.cart.index', compact('cart_items', 'total', 'quantity'));
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
            'product_id' => 'required',
            'qty' => 'integer|required|min:1|max:99'
        ]);

        $customer = auth()->user();
        $product = Product::find($request->product_id);
        $vendor = $product->vendor;
        $cart_item = new UserCart();
        $cart_item->product_id = $product->id;
        $cart_item->customer_id = $customer->id;
        $cart_item->vendor_id = $vendor->id;
        $cart_item->qty = $request->qty;
        $cart_item->save();
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
        $cart_item = UserCart::find($id);
        if ($customer->id != $cart_item->customer_id) {
            return redirect()->back();
        }
        $cart_item->load('product');
        return view('user.cart.edit', compact('cart_item'));
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
            'qty' => 'integer|required|min:1|max:99'
        ]);
        $customer = auth()->user();
        $cart_item = UserCart::find($id);
        if ($customer->id != $cart_item->customer_id) {
            return redirect()->back();
        }
        $cart_item->qty = $request->qty;
        $cart_item->update();
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
        $cart_item = UserCart::find($id);
        if ($customer->id != $cart_item->customer_id) {
            return redirect()->back();
        }
        $cart_item->delete();
        return redirect('app/cart');
    }
    public function confirm()
    {
        $customer = auth()->user();
        $delivery = intval(env('DELIVERY_CHARGE', 50));
        $addresses = $customer->addresses;
        $addresses->load('city');
        // $data = $this->getCartData();
        $data = CartData::getCartData($customer);
        $quantity = $data['quantity'];
        $total = $data['total'];
        return view('user.cart.confirm', compact('addresses', 'delivery','quantity','total','customer'));
    }

}

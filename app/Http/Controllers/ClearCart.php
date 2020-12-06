<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class ClearCart extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:webcustomer');
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $customer = auth('webcustomer')->user();
        $cart_items=$customer->cart_items;
        $cart_items->each->delete();
        return redirect()->back();
    }
}

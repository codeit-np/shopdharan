<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class ClearCart extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $customer = Customer::all()[0];
        $cart_items=$customer->cart_items;
        $cart_items->each->delete();
        return redirect()->back();
    }
}

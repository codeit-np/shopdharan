<?php 

namespace App\Helpers;

class CartData{
    public static function getCartData($customer){
        $cart_items = $customer->cart_items;
        $cart_items->load('product');
        $total = 0;
        $quantity = 0;
        foreach ($cart_items as $cart_item) {
            $price = $cart_item->product->price - $cart_item->product->discount;
            $total += $cart_item->qty * $price;
            $quantity += $cart_item->qty;
        }
        return [
            'cart_items' => $cart_items,
            'total' => $total,
            'quantity' => $quantity
        ];
    }
}
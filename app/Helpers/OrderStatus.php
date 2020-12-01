<?php 

namespace App\Helpers;

class OrderStatus{

    public static function get(){
        $val = [
            'Pending'=>'Pending',
            'Processing'=>'Processing',
            'Delivering'=>'Delivering',
            'Delivered'=>'Delivered',
            'Cancelled'=>'Cancelled',
        ];
        return $val;
    }
}
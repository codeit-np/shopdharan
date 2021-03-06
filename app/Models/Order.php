<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function address(){
        return $this->belongsTo(Address::class);
    }
    public function items(){
        return $this->hasMany(OrderDetail::class);
    }
}

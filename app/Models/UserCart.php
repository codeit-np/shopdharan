<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCart extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}

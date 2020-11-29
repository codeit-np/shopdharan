<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    public function cart_items(){
        return $this->hasMany(UserCart::class);
    }

    public function addresses(){
        return $this->hasMany(Address::class);
    }
}

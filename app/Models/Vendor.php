<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    public function city(){
        return $this->belongsTo(City::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}

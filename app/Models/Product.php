<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // １つの商品は１つの仕入れ先に属する
    public function vendor() {
        return $this->belongsTo(Vendor::class, 'vendor_code', 'vendor_code');
    }
}

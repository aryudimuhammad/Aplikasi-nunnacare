<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    public function Produk()
    {
        return $this->belongsTo(Produk::class);
    }
    public function Cart()
    {
        return $this->belongsTo(Cart::class);
    }
}

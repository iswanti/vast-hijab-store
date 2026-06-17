<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [

    'user_id',
    'kode_product',
    'nama',
    'brand',
    'harga',
    'stok',
    'warna',
    'size',
    'gambar',



];

public function orderDetails()
{
    return $this->hasMany(
        OrderDetail::class
    );
}
}

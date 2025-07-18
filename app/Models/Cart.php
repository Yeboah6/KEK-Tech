<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
   protected $table = 'carts';

    protected $fillable = [
        'customer_id',
        'product_id',
        'cart_quantity'
    ];

   public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}

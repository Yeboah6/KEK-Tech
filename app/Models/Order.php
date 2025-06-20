<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'order_id',
        'customer_id',
        'cart_id',
        'address_id',
        'total'
    ];
}

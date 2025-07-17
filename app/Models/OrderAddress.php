<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    protected $table = 'order_addresses';

    protected $fillable = [
        'order_id',
        'first_name',
        'last_name',
        'company_name',
        'country',
        'address_1',
        'address_2',
        'city',
        'state',
        'zip_code',
        'email',
        'phone'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

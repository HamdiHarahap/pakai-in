<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_code',
        'user_id',
        'total_price',
        'shipping_price',
        'payment_method',
        'payment_status',
        'order_status',
        'midtrans_transaction',
        'address'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function items() {
        return $this->hasMany(OrderItem::class);
    }
}

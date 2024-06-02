<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class ordersItems extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'total_price',
        'order_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class);
    }
}

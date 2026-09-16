<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'shipping_cost',
        'courier',
        'shipping_address',
        'shipping_city',
        'shipping_district',
        'shipping_postal_code',
        'payment_method',
        'payment_status',
        'payment_proof',
        'payment_submitted_at',
        'payment_verified_at',
        'order_status',
        'tracking_number',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'total_amount' => 'decimal:2',
            'shipping_cost' => 'decimal:2',
            'payment_submitted_at' => 'datetime',
            'payment_verified_at' => 'datetime',
            'expires_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
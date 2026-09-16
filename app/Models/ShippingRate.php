<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingRate extends Model
{
    protected $fillable = [
        'courier',
        'city',
        'cost',
    ];

    protected function casts(): array
    {
        return [
            'cost' => 'decimal:2',
        ];
    }
}
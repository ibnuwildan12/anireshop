<?php

namespace Database\Seeders;

use App\Models\ShippingRate;
use Illuminate\Database\Seeder;

class ShippingRateSeeder extends Seeder
{
    public function run(): void
    {
        $rates = [
            ['courier' => 'JNE', 'city' => 'Boyolali', 'cost' => 15000],
            ['courier' => 'JNE', 'city' => 'Surakarta', 'cost' => 12000],
            ['courier' => 'JNE', 'city' => 'Semarang', 'cost' => 15000],
            ['courier' => 'JNE', 'city' => 'Salatiga', 'cost' => 12000],

            ['courier' => 'J&T', 'city' => 'Boyolali', 'cost' => 14000],
            ['courier' => 'J&T', 'city' => 'Surakarta', 'cost' => 11000],
            ['courier' => 'J&T', 'city' => 'Semarang', 'cost' => 14000],
            ['courier' => 'J&T', 'city' => 'Salatiga', 'cost' => 11000],
        ];

        foreach ($rates as $rate) {
            ShippingRate::updateOrCreate(
                [
                    'courier' => $rate['courier'],
                    'city' => $rate['city'],
                ],
                [
                    'cost' => $rate['cost'],
                ]
            );
        }
    }
}
<?php

namespace Database\Seeders;

use App\Models\ShippingRate;
use Illuminate\Database\Seeder;

class ShippingRateSeeder extends Seeder
{
    public function run(): void
    {
        $rates = [
            // JNE - origin: Musuk, Boyolali
            ['courier' => 'JNE', 'city' => 'Boyolali', 'cost' => 10000],
            ['courier' => 'JNE', 'city' => 'Surakarta', 'cost' => 12000],
            ['courier' => 'JNE', 'city' => 'Sukoharjo', 'cost' => 12000],
            ['courier' => 'JNE', 'city' => 'Klaten', 'cost' => 13000],
            ['courier' => 'JNE', 'city' => 'Karanganyar', 'cost' => 13000],
            ['courier' => 'JNE', 'city' => 'Sragen', 'cost' => 14000],
            ['courier' => 'JNE', 'city' => 'Salatiga', 'cost' => 15000],
            ['courier' => 'JNE', 'city' => 'Semarang', 'cost' => 16000],
            ['courier' => 'JNE', 'city' => 'Magelang', 'cost' => 16000],
            ['courier' => 'JNE', 'city' => 'Yogyakarta', 'cost' => 17000],

            // J&T - origin: Musuk, Boyolali
            ['courier' => 'J&T', 'city' => 'Boyolali', 'cost' => 10000],
            ['courier' => 'J&T', 'city' => 'Surakarta', 'cost' => 11000],
            ['courier' => 'J&T', 'city' => 'Sukoharjo', 'cost' => 11000],
            ['courier' => 'J&T', 'city' => 'Klaten', 'cost' => 12000],
            ['courier' => 'J&T', 'city' => 'Karanganyar', 'cost' => 12000],
            ['courier' => 'J&T', 'city' => 'Sragen', 'cost' => 13000],
            ['courier' => 'J&T', 'city' => 'Salatiga', 'cost' => 14000],
            ['courier' => 'J&T', 'city' => 'Semarang', 'cost' => 15000],
            ['courier' => 'J&T', 'city' => 'Magelang', 'cost' => 15000],
            ['courier' => 'J&T', 'city' => 'Yogyakarta', 'cost' => 16000],
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
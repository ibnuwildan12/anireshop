<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'ibnuwildan12@gmail.com'],
            [
                'name' => 'Anireshop Admin',
                'whatsapp' => '081328971435',
                'password' => Hash::make(env('DEMO_ADMIN_PASSWORD')),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer@anireshop.com'],
            [
                'name' => 'Anireshop Customer',
                'whatsapp' => '085600635251',
                'password' => Hash::make(env('DEMO_ADMIN_PASSWORD')),
                'role' => 'customer',
            ]
        );
    }
}
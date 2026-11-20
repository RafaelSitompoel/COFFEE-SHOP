<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@coffeeshop.com'],
            [
                'name' => 'Super Admin Aura',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_admin' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'barista@coffeeshop.com'],
            [
                'name' => 'Lead Barista Siantar',
                'password' => Hash::make('password'),
                'role' => 'lead_barista',
                'is_admin' => false,
            ]
        );
    }
}

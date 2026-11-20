<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            [
                'name' => 'Dimas Pratama',
                'email' => 'dimas.pratama@gmail.com',
                'phone' => '081298765432',
                'address' => 'Jl. Sutomo No. 12, Pematangsiantar',
            ],
            [
                'name' => 'Nadia Rahmawati',
                'email' => 'nadia.rahma@yahoo.com',
                'phone' => '085712345678',
                'address' => 'Jl. Merdeka No. 88, Pematangsiantar',
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@outlook.com',
                'phone' => '087890123456',
                'address' => 'Jl. Gereja No. 5, Pematangsiantar',
            ],
            [
                'name' => 'Siti Aisyah',
                'email' => 'siti.aisyah@gmail.com',
                'phone' => '082155667788',
                'address' => 'Jl. Ahmad Yani No. 18, Pematangsiantar',
            ],
            [
                'name' => 'Rian Hidayat',
                'email' => 'rian.hidayat@gmail.com',
                'phone' => '081344556677',
                'address' => 'Jl. Asahan Km 4, Pematangsiantar',
            ],
        ];

        foreach ($customers as $c) {
            Customer::updateOrCreate(['phone' => $c['phone']], $c);
        }
    }
}

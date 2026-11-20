<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'shop_name' => 'Aura Coffee & Roastery',
                'logo' => null,
                'address' => 'Jl. Sutomo No. 45, Pematangsiantar, Sumatera Utara, 21111',
                'whatsapp_number' => '081234567890',
                'email' => 'halo@auracoffee.id',
                'description' => 'Aura Coffee menyajikan kopi spesialti biji pilihan Nusantara dan racikan artisan terbaik untuk menemani setiap cerita dan inspirasi hari Anda.',
                'bank_info' => "Bank Central Asia (BCA)\nNo. Rekening: 8820 1928 31\nAtas Nama: PT Aura Kopi Nusantara\n\nBank Mandiri\nNo. Rekening: 137 00 1928 3740\nAtas Nama: PT Aura Kopi Nusantara",
            ]
        );
    }
}

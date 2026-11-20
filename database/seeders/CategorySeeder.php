<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Espresso Based',
                'slug' => 'espresso-based',
                'description' => 'Minuman kopi klasik dan modern berbasis espresso berkualitas tinggi yang diekstrak dengan presisi.',
                'image' => 'https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?auto=format&fit=crop&w=600&q=80',
                'is_active' => true,
            ],
            [
                'name' => 'Manual Brew & Single Origin',
                'slug' => 'manual-brew-single-origin',
                'description' => 'Seduhan tangan V60, Aeropress, dan Japanese Iced dengan varietas biji kopi pilihan nusantara.',
                'image' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=600&q=80',
                'is_active' => true,
            ],
            [
                'name' => 'Signature Cold Brew',
                'slug' => 'signature-cold-brew',
                'description' => 'Kopi seduh dingin selama 16 jam dengan rasa lembut, rendah asam, dan aroma buah yang menyegarkan.',
                'image' => 'https://images.unsplash.com/photo-1517701604599-bb29b565090c?auto=format&fit=crop&w=600&q=80',
                'is_active' => true,
            ],
            [
                'name' => 'Artisan Tea & Non-Coffee',
                'slug' => 'artisan-tea-non-coffee',
                'description' => 'Pilihan teh aromatik, matcha premium, cokelat artisan Belgia untuk kesegaran harian.',
                'image' => 'https://images.unsplash.com/photo-1536256263959-770b48d82b0a?auto=format&fit=crop&w=600&q=80',
                'is_active' => true,
            ],
            [
                'name' => 'Pastry & Bakery',
                'slug' => 'pastry-bakery',
                'description' => 'Croissant renyah berlapis mentega Prancis dan pastry fresh-baked setiap pagi.',
                'image' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?auto=format&fit=crop&w=600&q=80',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}

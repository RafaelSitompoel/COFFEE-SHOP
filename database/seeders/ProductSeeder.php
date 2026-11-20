<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $espressoCategory = Category::where('slug', 'espresso-based')->first();
        $manualCategory = Category::where('slug', 'manual-brew-single-origin')->first();
        $coldBrewCategory = Category::where('slug', 'signature-cold-brew')->first();
        $nonCoffeeCategory = Category::where('slug', 'artisan-tea-non-coffee')->first();
        $pastryCategory = Category::where('slug', 'pastry-bakery')->first();

        $products = [
            // Espresso Based
            [
                'category_id' => $espressoCategory->id,
                'name' => 'Caffe Americano Classico',
                'slug' => 'caffe-americano-classico',
                'sku' => 'CF-ESP-001',
                'image' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=600&q=80',
                'description' => 'Double shot espresso murni dari biji Arabika Gayo dicampur air mineral panas dengan krema emas yang pekat.',
                'price' => 28000,
                'discount_price' => 25000,
                'stock' => 50,
                'status' => 'active',
                'is_featured' => true,
            ],
            [
                'category_id' => $espressoCategory->id,
                'name' => 'Caramel Macchiato Velvet',
                'slug' => 'caramel-macchiato-velvet',
                'sku' => 'CF-ESP-002',
                'image' => 'https://images.unsplash.com/photo-1485808191679-5f86510681a2?auto=format&fit=crop&w=600&q=80',
                'description' => 'Susu segar berbusa lembut dengan sirup vanilla artisan, di-drizzle saus karamel mentega gurih dan double shot espresso.',
                'price' => 38000,
                'discount_price' => 34000,
                'stock' => 45,
                'status' => 'active',
                'is_featured' => true,
            ],
            [
                'category_id' => $espressoCategory->id,
                'name' => 'Spanish Latte Dulce',
                'slug' => 'spanish-latte-dulce',
                'sku' => 'CF-ESP-003',
                'image' => 'https://images.unsplash.com/photo-1534778101976-62847782c213?auto=format&fit=crop&w=600&q=80',
                'description' => 'Perpaduan seimbang antara condensed milk creamy, susu segar steamed, dan espresso pekat rasa cokelat kacang.',
                'price' => 36000,
                'discount_price' => null,
                'stock' => 60,
                'status' => 'active',
                'is_featured' => true,
            ],
            [
                'category_id' => $espressoCategory->id,
                'name' => 'Flat White Microfoam',
                'slug' => 'flat-white-microfoam',
                'sku' => 'CF-ESP-004',
                'image' => 'https://images.unsplash.com/photo-1577968897966-3d4325b36b61?auto=format&fit=crop&w=600&q=80',
                'description' => 'Ristretto ganda dengan microfoam susu yang sangat lembut, menonjolkan aroma buah dan rasa manis alami susu.',
                'price' => 32000,
                'discount_price' => null,
                'stock' => 35,
                'status' => 'active',
                'is_featured' => false,
            ],

            // Manual Brew & Single Origin
            [
                'category_id' => $manualCategory->id,
                'name' => 'Single Origin Gayo Wine Honey (V60)',
                'slug' => 'single-origin-gayo-wine-honey-v60',
                'sku' => 'CF-MAN-001',
                'image' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=600&q=80',
                'description' => 'Biji kopi proses fermentasi wine dari Takengon Aceh. Tasting notes: Anggur hitam, kismis, madu liar, dan keasaman sitrus yang menyegarkan.',
                'price' => 42000,
                'discount_price' => 38000,
                'stock' => 25,
                'status' => 'active',
                'is_featured' => true,
            ],
            [
                'category_id' => $manualCategory->id,
                'name' => 'Single Origin Toraja Sapan Fully Washed',
                'slug' => 'single-origin-toraja-sapan',
                'sku' => 'CF-MAN-002',
                'image' => 'https://images.unsplash.com/photo-1511920170033-f8396924c348?auto=format&fit=crop&w=600&q=80',
                'description' => 'Biji kopi dari dataran tinggi Toraja Sulawesi Selatan dengan karakter body penuh, aroma rempah herbal manis, dan sentuhan cokelat pekat.',
                'price' => 40000,
                'discount_price' => null,
                'stock' => 30,
                'status' => 'active',
                'is_featured' => false,
            ],

            // Cold Brew
            [
                'category_id' => $coldBrewCategory->id,
                'name' => 'Peach Blossom Cold Brew 250ml',
                'slug' => 'peach-blossom-cold-brew',
                'sku' => 'CF-CLD-001',
                'image' => 'https://images.unsplash.com/photo-1517701604599-bb29b565090c?auto=format&fit=crop&w=600&q=80',
                'description' => 'Cold brew 18 jam diinfus dengan ekstrak buah persik asli dan irisan lemon segar. Manis lembut, floral, dan menyegarkan.',
                'price' => 35000,
                'discount_price' => 30000,
                'stock' => 40,
                'status' => 'active',
                'is_featured' => true,
            ],
            [
                'category_id' => $coldBrewCategory->id,
                'name' => 'Nitro Vanilla Sweet Cream Cold Brew',
                'slug' => 'nitro-vanilla-sweet-cream',
                'sku' => 'CF-CLD-002',
                'image' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?auto=format&fit=crop&w=600&q=80',
                'description' => 'Cold brew kaya rasa dengan cascading foam nitrogen di atasnya, disempurnakan dengan limpahan sweet cream vanilla buatan sendiri.',
                'price' => 39000,
                'discount_price' => null,
                'stock' => 20,
                'status' => 'active',
                'is_featured' => true,
            ],

            // Non-Coffee
            [
                'category_id' => $nonCoffeeCategory->id,
                'name' => 'Kyoto Ceremonial Uji Matcha Latte',
                'slug' => 'kyoto-ceremonial-uji-matcha-latte',
                'sku' => 'CF-NON-001',
                'image' => 'https://images.unsplash.com/photo-1536256263959-770b48d82b0a?auto=format&fit=crop&w=600&q=80',
                'description' => 'Matcha ceremonial grade asli Kyoto Jepang yang dikocok tradisional dengan chasen bambu, dipadukan susu oat krimi.',
                'price' => 37000,
                'discount_price' => 33000,
                'stock' => 50,
                'status' => 'active',
                'is_featured' => true,
            ],
            [
                'category_id' => $nonCoffeeCategory->id,
                'name' => 'Belgian Dark Chocolate Sea Salt',
                'slug' => 'belgian-dark-chocolate-sea-salt',
                'sku' => 'CF-NON-002',
                'image' => 'https://images.unsplash.com/photo-1542990253-0d0f5be5f0ed?auto=format&fit=crop&w=600&q=80',
                'description' => 'Cokelat hitam murni Belgia 70% dilelehkan bersama susu hangat dan taburan sea salt Maldon untuk rasa gurih mewah.',
                'price' => 35000,
                'discount_price' => null,
                'stock' => 40,
                'status' => 'active',
                'is_featured' => false,
            ],

            // Pastry & Bakery
            [
                'category_id' => $pastryCategory->id,
                'name' => 'French Butter Croissant',
                'slug' => 'french-butter-croissant',
                'sku' => 'CF-PAS-001',
                'image' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?auto=format&fit=crop&w=600&q=80',
                'description' => 'Pastry berlapis mentega Prancis Elle & Vire dengan kulit luar super renyah keemasan dan tekstur dalam empuk berongga.',
                'price' => 24000,
                'discount_price' => 21000,
                'stock' => 30,
                'status' => 'active',
                'is_featured' => true,
            ],
            [
                'category_id' => $pastryCategory->id,
                'name' => 'Pain Au Chocolat Royal',
                'slug' => 'pain-au-chocolat-royal',
                'sku' => 'CF-PAS-002',
                'image' => 'https://images.unsplash.com/photo-1608198093002-ad4e005484ec?auto=format&fit=crop&w=600&q=80',
                'description' => 'Croissant dengan isian double stick dark chocolate couverture leleh yang kaya rasa.',
                'price' => 28000,
                'discount_price' => null,
                'stock' => 25,
                'status' => 'active',
                'is_featured' => false,
            ],
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(['sku' => $p['sku']], $p);
        }
    }
}

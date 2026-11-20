<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_name',
        'logo',
        'address',
        'whatsapp_number',
        'email',
        'description',
        'bank_info',
    ];

    public static function getShopSettings(): self
    {
        return static::firstOrCreate([], [
            'shop_name' => 'Aura Coffee & Roastery',
            'logo' => null,
            'address' => 'Jl. Sutomo No. 45, Pematangsiantar, Sumatera Utara, 21111',
            'whatsapp_number' => '081234567890',
            'email' => 'contact@auracoffee.id',
            'description' => 'Menyajikan biji kopi artisanal pilihan dari seluruh penjuru nusantara dan mancanegara dengan roasting sempurna.',
            'bank_info' => "BCA: 8820192831 a/n PT Aura Kopi Nusantara\nMandiri: 137001928374 a/n PT Aura Kopi Nusantara",
        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'invoice_number',
        'order_date',
        'total_amount',
        'status',
        'payment_status',
        'payment_method',
        'customer_name',
        'customer_phone',
        'shipping_address',
        'notes',
        'courier_name',
        'driver_name',
        'driver_phone',
        'driver_plate',
        'driver_status',
    ];

    protected $casts = [
        'order_date' => 'datetime',
        'total_amount' => 'decimal:2',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class)->latestOfMany();
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public static function generateInvoiceNumber(): string
    {
        $prefix = 'INV-' . date('Ymd') . '-';
        $random = strtoupper(Str::random(4));
        return $prefix . $random;
    }

    protected static function booted(): void
    {
        static::saved(function (Order $order) {
            if ($order->wasChanged('payment_status') && $order->payment) {
                $order->payment->updateQuietly([
                    'payment_status' => $order->payment_status,
                    'payment_date' => $order->payment_status === 'Paid' ? ($order->payment->payment_date ?? now()) : $order->payment->payment_date,
                ]);
            }
        });
    }
}

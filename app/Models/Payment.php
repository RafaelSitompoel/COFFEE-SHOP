<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_method',
        'amount',
        'payment_status',
        'payment_proof',
        'payment_date',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'datetime',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    protected static function booted(): void
    {
        static::saved(function (Payment $payment) {
            if ($payment->wasChanged('payment_status') && $payment->order) {
                $updateData = ['payment_status' => $payment->payment_status];
                if ($payment->payment_status === 'Paid' && $payment->order->status === 'Pending') {
                    $updateData['status'] = 'Processing';
                }
                $payment->order->updateQuietly($updateData);
            }
        });
    }
}

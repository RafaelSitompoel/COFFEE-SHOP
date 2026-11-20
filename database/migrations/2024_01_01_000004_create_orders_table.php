<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->string('invoice_number')->unique();
            $table->dateTime('order_date');
            $table->decimal('total_amount', 12, 2);
            $table->string('status')->default('Pending'); // Pending, Processing, Shipped, Completed, Cancelled
            $table->string('payment_status')->default('Unpaid'); // Unpaid, Paid, Failed, Refunded
            $table->string('payment_method')->default('Transfer Bank'); // Transfer Bank, Cash on Delivery
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->text('shipping_address');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['invoice_number', 'status', 'payment_status', 'order_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('courier_name')->nullable()->after('shipping_address')->default('Gojek (GoSend)');
            $table->string('driver_name')->nullable()->after('courier_name');
            $table->string('driver_phone')->nullable()->after('driver_name');
            $table->string('driver_plate')->nullable()->after('driver_phone');
            $table->string('driver_status')->nullable()->after('driver_plate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'courier_name',
                'driver_name',
                'driver_phone',
                'driver_plate',
                'driver_status',
            ]);
        });
    }
};

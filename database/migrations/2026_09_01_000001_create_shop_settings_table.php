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
        Schema::create('shop_settings', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name')->default('Prakriti Kerala');
            $table->text('warehouse_address')->nullable();
            $table->decimal('latitude', 10, 7)->default(9.9312328);
            $table->decimal('longitude', 10, 7)->default(76.2673041);
            $table->decimal('free_delivery_radius_km', 5, 2)->default(3.00);
            $table->boolean('enable_free_delivery')->default(true);
            $table->boolean('enable_cod')->default(true);
            $table->decimal('cod_extra_charge', 8, 2)->default(0.00);
            $table->decimal('standard_shipping_fee', 8, 2)->default(50.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_settings');
    }
};

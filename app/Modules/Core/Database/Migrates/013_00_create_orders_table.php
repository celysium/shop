<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('users');
            $table->foreignId('address_id')->nullable()->constrained('addresses');
            $table->foreignId('delivery_id')->nullable()->constrained('deliveries');
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedBigInteger('total_buy_price')->default(0);
            $table->unsignedBigInteger('total_promotion_price')->default(0);
            $table->unsignedBigInteger('total_discount_price')->default(0);
            $table->unsignedBigInteger('total_price')->default(0);
            $table->unsignedBigInteger('total_profit_price')->default(0);
            $table->json('details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

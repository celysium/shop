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
        Schema::create('carts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('customer_id')->nullable()->constrained('users');
            $table->foreignId('address_id')->nullable()->constrained('addresses');
            $table->foreignId('delivery_id')->nullable()->constrained('deliveries');
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedBigInteger('total_promoted_price')->default(0);
            $table->unsignedBigInteger('total_discount_price')->default(0);
            $table->unsignedBigInteger('total_price')->default(0);
            $table->json('items')->nullable();
            $table->json('details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};

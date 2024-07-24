<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('product_id')->constrained('products');
            $table->unsignedSmallInteger('quantity')->default(1);
            $table->unsignedBigInteger('buy_price');
            $table->unsignedBigInteger('original_price');
            $table->unsignedBigInteger('promoted_price')->nullable();
            $table->unsignedBigInteger('total_price')->default(0);
            $table->unsignedBigInteger('total_profit_price')->default(0);
            $table->json('cache')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};

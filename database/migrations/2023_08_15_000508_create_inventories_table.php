<?php

use App\Enumerations\Product\Status;
use App\Enumerations\Product\Type;
use App\Enumerations\Product\Visibility;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('store_id')->constrained('stores');
            $table->unsignedInteger('quantity')->default(0);
            $table->unsignedBigInteger('buy_price')->default(0);
            $table->unsignedBigInteger('original_price')->default(0);
            $table->unsignedBigInteger('promoted_price')->nullable();
            $table->timestamp('promoted_activated_at')->nullable();
            $table->timestamp('promoted_expired_at')->nullable();
            $table->json('product')->nullable();
            $table->json('store')->nullable();
            $table->json('images')->nullable();
            $table->json('categories')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};

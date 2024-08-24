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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->fulltext();
            $table->string('sku')->unique()->fulltext();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('type')->default(0);
            $table->unsignedTinyInteger('status')->default(0);
            $table->boolean('visibility')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('category_id')->constrained('categories');
            $table->unique(['product_id', 'category_id']);
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->string('path');
            $table->unsignedTinyInteger('position')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('category_product');
        Schema::dropIfExists('products');
    }
};

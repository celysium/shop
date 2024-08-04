<?php

use App\Modules\Core\Enumerations\Product\Status;
use App\Modules\Core\Enumerations\Product\Type;
use App\Modules\Core\Enumerations\Product\Visibility;
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
        Schema::create('product_indices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->string('name')->unique()->fulltext();
            $table->string('sku')->unique()->fulltext();
            $table->string('slug')->unique();
            $table->foreignId('parent_id')->nullable()->constrained('products');
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('type')->default(TYPE::SIMPLE);
            $table->unsignedTinyInteger('status')->default(STATUS::INACTIVE);
            $table->boolean('visibility')->default(Visibility::INVISIBLE);
            $table->boolean('is_stock')->default(false);
            $table->unsignedInteger('quantity')->default(0);
            $table->unsignedBigInteger('buy_price')->default(0);
            $table->unsignedBigInteger('original_price')->default(0);
            $table->unsignedBigInteger('promoted_price')->nullable();
            $table->timestamp('promoted_activated_at')->nullable();
            $table->timestamp('promoted_expired_at')->nullable();
            $table->json('categories')->nullable();
            $table->json('images')->nullable();
            $table->json('stores')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_indices');
    }
};

<?php

use App\Enumerations\Product\Status;
use App\Enumerations\Product\Type;
use App\Enumerations\Product\Visibility;
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
            $table->string('name');
            $table->string('sku')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('type')->default(TYPE::SIMPLE);
            $table->unsignedTinyInteger('status')->default(STATUS::INACTIVE);
            $table->boolean('visibility')->default(Visibility::INVISIBLE);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

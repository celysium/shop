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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->foreignId('province_id')->nullable()->constrained('locations');
            $table->foreignId('city_id')->nullable()->constrained('locations');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->tinyText('detail')->nullable();
            $table->string('postcode')->nullable();
            $table->string('plate_number')->nullable();
            $table->string('floor')->nullable();
            $table->string('unit')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};

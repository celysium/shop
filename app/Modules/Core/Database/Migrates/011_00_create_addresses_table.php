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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('province_id')->constrained('locations');
            $table->foreignId('city_id')->constrained('locations');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->tinyText('detail');
            $table->string('postcode')->nullable();
            $table->string('plate')->nullable();
            $table->string('floor')->nullable();
            $table->string('unit')->nullable();
            $table->boolean('is_default')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};

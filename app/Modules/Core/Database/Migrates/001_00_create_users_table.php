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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('mobile')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('password')->nullable();
            $table->string('avatar')->nullable();
            $table->string('status')->default(1);
            $table->string('gender')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('password_tokens', function (Blueprint $table) {
            $table->string('username')->primary();
            $table->string('token');
            $table->unsignedTinyInteger('tries')->default(0);
            $table->timestamp('sent_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_tokens');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('parent_id')->nullable()->constrained('categories');
            $table->string('slug')->unique();
            $table->tinyInteger('visible')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->unsignedTinyInteger('position')->default(0);
            $table->string('icon')->nullable();
            $table->string('banner')->nullable();
            $table->text('description')->nullable();
            $table->json('path')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

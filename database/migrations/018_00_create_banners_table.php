<?php

use App\Enumerations\Banner\Status;
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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('slider_id')->nullable()->constrained('sliders');
            $table->string('path');
            $table->string('title');
            $table->string('url');
            $table->unsignedTinyInteger('position')->default(0);
            $table->tinyInteger('status')->default(Status::ACTIVE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};

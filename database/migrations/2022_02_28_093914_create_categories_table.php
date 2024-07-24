<?php

use App\Enumerations\Category\Status;
use App\Enumerations\Category\Visibility;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('parent_id')->nullable()->constrained('categories');
            $table->string('slug')->unique();
            $table->tinyInteger('visible')->default(Visibility::VISIBLE->value);
            $table->tinyInteger('status')->default(Status::ACTIVE->value);
            $table->json('path')->nullable();
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('level')->nullable();
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('position')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};

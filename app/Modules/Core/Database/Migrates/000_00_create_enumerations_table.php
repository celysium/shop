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
        Schema::create('enumerations', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('field');
            $table->string('case');
            $table->string('cast')->nullable();

            $table->unique(['model', 'field', 'case']);
            $table->unique(['model', 'field', 'cast']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enumerations');
    }
};

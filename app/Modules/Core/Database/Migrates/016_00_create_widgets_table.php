<?php

use App\Modules\Core\Enumerations\Widget\Status;
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
        Schema::create('widgets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(Status::ACTIVE);
            $table->timestamps();
        });

        Schema::create('product_widget', function (Blueprint $table) {
            $table->foreignId('widget_id')->constrained('widgets');
            $table->foreignId('product_id')->constrained('products');

            $table->unique(['widget_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_widget');
        Schema::dropIfExists('widgets');
    }
};

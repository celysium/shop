<?php

namespace Core\Database\Migrations;

use App\Enumerations\Payment\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('users');
            $table->foreignId('order_id')->nullable()->constrained('orders');
            $table->unsignedTinyInteger('status')->default(Status::PENDING);
            $table->char('transaction_id')->nullable();
            $table->char('reference_id')->nullable();
            $table->unsignedBigInteger('amount');
            $table->longText('request')->nullable();
            $table->longText('response')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('order_number')->unique();
            $table->date('visit_date');
            $table->tinyInteger('session'); // 1, 2, 3
            $table->enum('ticket_type', ['weekday', 'weekend']);
            $table->unsignedSmallInteger('qty_adult')->default(0);
            $table->unsignedSmallInteger('qty_child')->default(0);
            $table->unsignedInteger('price_per_ticket'); // in rupiah
            $table->unsignedInteger('total_price');
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

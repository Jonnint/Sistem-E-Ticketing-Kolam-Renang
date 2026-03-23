<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('payment_method', ['cash', 'online'])->default('cash')->after('status');
            // Expand status enum by recreating the column
            $table->string('status')->default('pending_cash')->change();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('payment_method');
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending')->change();
        });
    }
};

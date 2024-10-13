<?php

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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payway')->nullable(); // Payment method, e.g., "credit card", "paypal"
            $table->decimal('price', 10, 2)->nullable(); // Price with two decimal places
            $table->decimal('discount', 10, 2)->nullable(); // Discount with two decimal places
            $table->decimal('total', 10, 2)->nullable(); // Total amount with two decimal places
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('payway');
            $table->dropColumn('price');
            $table->dropColumn('discount');
            $table->dropColumn('total');
        });
    }
};

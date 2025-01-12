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
        Schema::create('service_fields', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('field_id')->nullable();
            $table->foreign('field_id')
                ->references('id')
                ->on('fields')
                ->onDelete('cascade');

            $table->unsignedBigInteger('services_id')->nullable();
            $table->foreign('services_id')
                ->references('id')
                ->on('services')
                ->onDelete('cascade');
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_fields');
    }
};

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
        Schema::table('settings', function (Blueprint $table) {
            // Check if columns exist before dropping them
            if (Schema::hasColumn('settings', 'name_ar')) {
                $table->dropColumn('name_ar');
            }
            if (Schema::hasColumn('settings', 'name_en')) {
                $table->dropColumn('name_en');
            }
            if (Schema::hasColumn('settings', 'value_ar')) {
                $table->dropColumn('value_ar');
            }
            if (Schema::hasColumn('settings', 'value_en')) {
                $table->dropColumn('value_en');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            // Add columns back
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->string('value_ar')->nullable();
            $table->string('value_en')->nullable();
        });
    }
};

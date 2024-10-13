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
            $table->text('slug_ar')->nullable();
            $table->text('slug_en')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('video_link')->nullable();
            $table->string('pdf')->nullable(); // This will store the file path of the uploaded PDF
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('slug_ar');
            $table->dropColumn('slug_en');
            $table->dropColumn('phone1');
            $table->dropColumn('phone2');
            $table->dropColumn('whatsapp');
            $table->dropColumn('email');
            $table->dropColumn('facebook');
            $table->dropColumn('instagram');
            $table->dropColumn('video_link');
            $table->dropColumn('pdf');
        });
    }
};

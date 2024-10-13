<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('field_options', function (Blueprint $table) {
            $table->string('option_en')->nullable()->after('option'); // Example: Adding a nullable string column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('field_options', function (Blueprint $table) {
            $table->dropColumn('option_en');
        });
    }
};

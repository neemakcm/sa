<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('institution_dealership_email',256)->after('meta_title')->nullable();
            $table->string('dealer_email',256)->after('institution_dealership_email')->nullable();
            $table->string('otheremail',256)->after('dealer_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['institution_dealership_email','dealer_email','otheremail']);
        });
    }
}

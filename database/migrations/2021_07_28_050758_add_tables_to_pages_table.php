<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTablesToPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->longText('home_appilance_table')->after('ac_table')->nullable();

            $table->longText('entertainment_table')->after('home_appilance_table')->nullable();
            $table->longText('lighting_table')->after('entertainment_table')->nullable();
            $table->longText('personal_care_table')->after('lighting_table')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['home_appilance_table','entertainment_table','lighting_table','personal_care_table']);

        });
    }
}

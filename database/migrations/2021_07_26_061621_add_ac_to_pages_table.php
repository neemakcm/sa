<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAcToPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->text('av_description',256)->after('description')->nullable();
            $table->text('ac_description',256)->after('av_description')->nullable();
            $table->longText('av_table')->after('ac_description')->nullable();
            $table->longText('ac_table')->after('av_table')->nullable();
        
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
            $table->dropColumn(['av_description','ac_description','av_table','ac_table']);

        });
    }
}

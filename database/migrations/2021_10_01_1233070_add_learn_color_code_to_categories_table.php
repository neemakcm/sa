<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLearnColorCodeToCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('learn_more_bg_color',254)->after('banner_link')->nullable();
            $table->string('learn_more_color_code',254)->after('learn_more_bg_color')->nullable();
           
           });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['learn_more_bg_color','learn_more_color_code']);
        
        });
    }
}

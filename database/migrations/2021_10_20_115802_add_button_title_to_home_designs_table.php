<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddButtonTitleToHomeDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_design', function (Blueprint $table) {
            $table->text('learn_more_title')->after('learn_more')->nullable();
            $table->text('buy_now_title')->after('learn_more_title')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home_design', function (Blueprint $table) {
            $table->dropColumn(['buy_now_title','learn_more_title']);
        
        });
    }
}

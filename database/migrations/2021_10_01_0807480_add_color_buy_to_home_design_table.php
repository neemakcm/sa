<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorBuyToHomeDesignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_design', function (Blueprint $table) {
            $table->string('buy_now_bg_color_code',254)->after('description')->nullable();
            $table->string('buy_now_color_code',254)->after('buy_now_bg_color_code')->nullable();
            
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
            $table->dropColumn(['buy_now_bg_color_code','buy_now_color_code']);
        });
    }
}

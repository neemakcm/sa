<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorCodeToBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->string('title_color_code',254)->after('video')->nullable();
            $table->string('short_color_code',254)->after('title_color_code')->nullable();
            $table->string('description_color_code',254)->after('short_color_code')->nullable();
            $table->string('buy_now_bg_color_code',254)->after('description_color_code')->nullable();
            $table->string('buy_now_color_code',254)->after('buy_now_bg_color_code')->nullable();
            $table->string('learn_more_bg_color',254)->after('buy_now_color_code')->nullable();
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
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn(['title_color_code','short_color_code','description_color_code','buy_now_bg_color_code','buy_now_color_code','learn_more_bg_color','learn_more_color_code']);
        });
    }
}

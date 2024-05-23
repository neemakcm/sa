<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorCodeToLatestVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('latest_videos', function (Blueprint $table) {
            $table->string('title_color_code',254)->after('video')->nullable();
            $table->string('description_color_code',254)->after('title_color_code')->nullable();
            $table->string('description_font_size',254)->after('description_color_code')->nullable();
            $table->string('title_font_size',254)->after('description_font_size')->nullable();
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('latest_videos', function (Blueprint $table) {
            $table->dropColumn(['title_color_code','description_color_code','description_font_size','title_font_size']);
        });
    }
}

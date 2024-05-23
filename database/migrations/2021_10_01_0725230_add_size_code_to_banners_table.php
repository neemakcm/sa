<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSizeCodeToBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->string('description_font_size',254)->after('learn_more_color_code')->nullable();
            $table->string('short_font_size',254)->after('description_font_size')->nullable();
            $table->string('title_font_size',254)->after('short_font_size')->nullable();
            
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
            $table->dropColumn(['short_font_size','short_font_size','description_font_size']);
        });
    }
}

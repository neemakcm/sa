<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorToHomeDesignSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_design_subcategories', function (Blueprint $table) {
            $table->string('category_color_code',254)->after('online_link')->nullable();
            $table->string('category_font_size',254)->after('category_color_code')->nullable();
            $table->string('learn_more_bg_color',254)->after('category_font_size')->nullable();
            $table->string('learn_more_color_code',254)->after('learn_more_bg_color')->nullable();
            $table->string('buy_now_bg_color_code',254)->after('learn_more_color_code')->nullable();
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
        Schema::table('home_design_subcategories', function (Blueprint $table) {
            $table->dropColumn(['description_font_size','learn_more_color_code','learn_more_bg_color','description_color_code','category_font_size','category_color_code','buy_now_bg_color_code','buy_now_color_code']);
        
        });
    }
}

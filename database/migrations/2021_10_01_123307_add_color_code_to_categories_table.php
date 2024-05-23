<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorCodeToCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('main_title_color',254)->after('banner_main_title')->nullable();
            $table->string('sub_title_color',254)->after('main_title_color')->nullable();
            $table->string('short_description_color',254)->after('sub_title_color')->nullable();
           
            $table->string('short_description_size',254)->after('short_description_color')->nullable();
            $table->string('main_title_size',254)->after('short_description_size')->nullable();
            $table->string('sub_title_size',254)->after('main_title_size')->nullable();     
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
            $table->dropColumn(['main_title_color','sub_title_color','short_description_color','short_description_size','main_title_size','sub_title_size']);
        
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBannerDetailsInCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('desktop_banner',256)->after('meta_description')->nullable();
            $table->string('mobile_banner',256)->after('desktop_banner')->nullable();
            $table->string('banner_main_title',256)->after('mobile_banner')->nullable();
            $table->string('banner_sub_title',256)->after('banner_main_title')->nullable();
            $table->string('banner_small_description',256)->after('banner_sub_title')->nullable();
            $table->string('banner_link',256)->after('banner_small_description')->nullable();
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
            $table->dropColumn(['desktop_banner','mobile_banner','banner_main_title','banner_sub_title','banner_small_description','banner_link']);
        });
    }
}

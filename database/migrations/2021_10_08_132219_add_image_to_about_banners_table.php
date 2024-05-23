<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToAboutBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('about_banners', function (Blueprint $table) {
            $table->string('mobile_image',254)->after('image')->nullable();
            $table->string('tablet_image',254)->after('mobile_image')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('about_banners', function (Blueprint $table) {
            $table->dropColumn(['tablet_image','mobile_image']);
        });
    }
}

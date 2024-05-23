<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMobileImageToPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->text('sub_description')->after('sub_title')->nullable();
            $table->text('description_desktop_image_upload')->after('sub_description')->nullable();
            $table->text('description_mobile_image_upload')->after('description_desktop_image_upload')->nullable();
            $table->text('footer_desktop_image_upload')->after('description_mobile_image_upload')->nullable();
            $table->text('footer_mobile_image_upload')->after('footer_desktop_image_upload')->nullable();
            $table->text('footer_title')->after('footer_mobile_image_upload')->nullable();
            $table->text('footer_description')->after('footer_title')->nullable();
                  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['sub_description','description_desktop_image_upload','description_mobile_image_upload','description_mobile_image_upload','footer_desktop_image_upload','footer_mobile_image_upload','footer_title','footer_description']);
        });
    }
}

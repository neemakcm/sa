<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeInLatestVideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('latest_videos', function (Blueprint $table) {
            $table->integer('type')->after('thumbnail')->default(0)->comment('0-video,1-url');
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
            $table->dropColumn(['type']);
        });
    }
}

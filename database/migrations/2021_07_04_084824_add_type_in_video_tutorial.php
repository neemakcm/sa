<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeInVideoTutorial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('video_tutorial', function (Blueprint $table) {
            $table->integer('type')->after('description')->default(0)->comment('0-video,1-url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('video_tutorial', function (Blueprint $table) {
            $table->dropColumn(['type']);
        });
    }
}

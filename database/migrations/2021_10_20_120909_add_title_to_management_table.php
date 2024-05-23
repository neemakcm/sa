<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleToManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('management', function (Blueprint $table) {
            $table->text('name')->after('id')->nullable();
            $table->text('description')->after('title')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('management', function (Blueprint $table) {
            $table->dropColumn(['name','description']);
        
        });
    }
}

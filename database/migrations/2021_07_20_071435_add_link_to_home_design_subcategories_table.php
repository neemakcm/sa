<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLinkToHomeDesignSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_design_subcategories', function (Blueprint $table) {
            $table->string('online_link',256)->after('sub_category_id')->nullable();
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
            $table->dropColumn(['online_link']);
        });
    }
}

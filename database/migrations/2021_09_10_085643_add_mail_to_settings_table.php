<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMailToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('product_register_mail',256)->after('otheremail')->nullable();
            $table->string('waranty_extension_mail',256)->after('product_register_mail')->nullable();
            $table->string('product_feedback_mail',256)->after('waranty_extension_mail')->nullable();
            $table->string('service_feedback_mail',256)->after('product_feedback_mail')->nullable();
            $table->string('escalate_to_service_mail',256)->after('service_feedback_mail')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['product_register_mail','waranty_extension_mail','product_feedback_mail','service_feedback_mail','escalate_to_service_mail']);
        
        });
    }
}

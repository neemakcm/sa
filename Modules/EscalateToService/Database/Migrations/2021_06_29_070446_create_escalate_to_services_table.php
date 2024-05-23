<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscalateToServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escalate_to_services', function (Blueprint $table) {
            $table->increments('id');
			$table->string('first_name', 125);
			$table->string('last_name', 125);
			$table->string('mobile', 125);
			$table->string('email', 125);
			$table->text('address_1')->nullable();
			$table->text('address_2')->nullable();
			$table->string('district', 125)->nullable();
			$table->string('state', 125)->nullable();
			$table->string('pincode', 125)->nullable();
			$table->integer('product_id')->unsigned();
			$table->string('product_model', 125);
			$table->string('purchased_from', 125);
			$table->string('invoice', 256);
			$table->text('subject');
			$table->text('message');
			$table->integer('status')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escalate_to_services');
    }
}

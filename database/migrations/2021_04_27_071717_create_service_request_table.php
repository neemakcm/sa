<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiceRequestTable extends Migration {

	public function up()
	{
		Schema::create('service_request', function(Blueprint $table) {
			$table->increments('id');
			$table->string('reference_number', 125);
			$table->string('complaint_id', 125)->nullable();
			$table->string('service_type', 125);
			$table->integer('product_id');
			$table->string('model_number', 125);
			$table->string('serial_number', 125);
			$table->string('purchased_date', 125);
			$table->string('warranty_type', 125);
			$table->string('proof', 125);
			$table->longText('description');
			$table->string('first_name', 125);
			$table->string('last_name', 125);
			$table->string('email', 125);
			$table->string('mobile', 125);
			$table->text('address_1');
			$table->text('address_2')->nullable();
			$table->string('district', 125);
			$table->string('state', 125);
			$table->string('pincode', 125);
			$table->integer('status')->default('0');
			$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
		});
	}

	public function down()
	{
		Schema::drop('service_request');
	}
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductEnquiryTable extends Migration {

	public function up()
	{
		Schema::create('product_enquiry', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id')->unsigned();
			$table->string('product_model', 125);
			$table->string('enquiry_type', 125);
			$table->string('first_name', 125);
			$table->string('last_name', 125);
			$table->string('email', 125);
			$table->string('mobile', 125);
			$table->text('address_1');
			$table->text('address_2')->nullable();
			$table->string('district', 125);
			$table->string('state', 125);
			$table->string('pincode', 125);
			$table->text('message');
			$table->integer('status')->default('0');
			$table->text('description')->nullable();
			$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
		});
	}

	public function down()
	{
		Schema::drop('product_enquiry');
	}
}
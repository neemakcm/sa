<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiceFeedbackTable extends Migration {

	public function up()
	{
		Schema::create('service_feedback', function(Blueprint $table) {
			$table->increments('id');
			$table->string('first_name', 125);
			$table->string('last_name', 125);
			$table->string('email', 125);
			$table->string('mobile', 125);
			$table->string('case_number', 125);
			$table->string('attachment', 125);
			$table->integer('is_fixed')->default('0');
			$table->integer('rating')->default('1');
			$table->text('comments')->nullable();
			$table->integer('status')->default('0');
			$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
		});
	}

	public function down()
	{
		Schema::drop('service_feedback');
	}
}
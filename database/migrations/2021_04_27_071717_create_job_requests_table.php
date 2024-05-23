<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobRequestsTable extends Migration {

	public function up()
	{
		Schema::create('job_requests', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('job_id')->unsigned();
			$table->string('first_name', 125);
			$table->string('last_name', 125);
			$table->string('email', 125);
			$table->string('mobile', 125);
			$table->string('city', 125);
			$table->string('state', 125);
			$table->text('address');
			$table->text('skill_set');
			$table->string('resume', 256);
			$table->string('cover_letter', 256);
			$table->integer('status')->default('0');
			$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
		});
	}

	public function down()
	{
		Schema::drop('job_requests');
	}
}
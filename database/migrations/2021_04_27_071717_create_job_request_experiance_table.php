<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobRequestExperianceTable extends Migration {

	public function up()
	{
		Schema::create('job_request_experiance', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('job_request_id')->unsigned();
			$table->string('institute', 125);
			$table->string('job_title', 125);
			$table->string('experience', 125);
			$table->string('from_month', 125);
			$table->string('from_year', 125);
			$table->string('to_month', 125);
			$table->string('to_year', 125);
			$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
		});
	}

	public function down()
	{
		Schema::drop('job_request_experiance');
	}
}
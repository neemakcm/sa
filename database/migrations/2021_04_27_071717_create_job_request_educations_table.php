<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobRequestEducationsTable extends Migration {

	public function up()
	{
		Schema::create('job_request_educations', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('job_request_id')->unsigned();
			$table->string('institute', 125);
			$table->string('department', 125);
			$table->string('degree', 125);
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
		Schema::drop('job_request_educations');
	}
}
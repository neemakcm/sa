<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobsTable extends Migration {

	public function up()
	{
		Schema::create('jobs', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 256);
			$table->string('location', 125);
			$table->text('company');
			$table->text('rememberToken');
			$table->text('responsibilities');
			$table->integer('statu')->default('0');
			$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
		});
	}

	public function down()
	{
		Schema::drop('jobs');
	}
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiceCenterTable extends Migration {

	public function up()
	{
		Schema::create('service_center', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 256);
			$table->text('description');
			$table->string('state', 125);
			$table->string('district', 125);
			$table->string('mobile', 125);
			$table->string('email', 125);
			$table->string('open_hour', 125);
			$table->string('location', 256);
			$table->string('latitude', 125);
			$table->string('longitude', 125);
			$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
		});
	}

	public function down()
	{
		Schema::drop('service_center');
	}
}
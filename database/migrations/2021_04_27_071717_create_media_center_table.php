<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMediaCenterTable extends Migration {

	public function up()
	{
		Schema::create('media_center', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 125);
			$table->text('description');
			$table->string('media', 256);
			$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
		});
	}

	public function down()
	{
		Schema::drop('media_center');
	}
}
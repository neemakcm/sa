<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVideoTutorialTable extends Migration {

	public function up()
	{
		Schema::create('video_tutorial', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('category_id');
			$table->string('title', 125);
			$table->text('description');
			$table->string('video', 256);
			$table->string('thumbnail', 256);
			$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
		});
	}

	public function down()
	{
		Schema::drop('video_tutorial');
	}
}
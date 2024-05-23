<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 125);
			$table->string('slug', 256)->nullable();
			$table->string('icon', 256)->nullable();
			$table->integer('parent_id')->unsigned()->default('0');
			$table->integer('is_last_child')->default('0');
			$table->integer('status')->default(1);
			$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
		});
	}

	public function down()
	{
		Schema::drop('categories');
	}
}
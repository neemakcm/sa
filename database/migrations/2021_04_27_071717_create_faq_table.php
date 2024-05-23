<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFaqTable extends Migration {

	public function up()
	{
		Schema::create('faq', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('category_id');
			$table->string('question', 256);
			$table->text('answer');
			$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
		});
	}

	public function down()
	{
		Schema::drop('faq');
	}
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductCompareTable extends Migration {

	public function up()
	{
		Schema::create('product_compare', function(Blueprint $table) {
			$table->increments('id');
			$table->string('session_id', 125);
			$table->integer('product_id')->unsigned();
			$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
		});
	}

	public function down()
	{
		Schema::drop('product_compare');
	}
}
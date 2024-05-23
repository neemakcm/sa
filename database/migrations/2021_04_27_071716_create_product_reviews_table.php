<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductReviewsTable extends Migration {

	public function up()
	{
		Schema::create('product_reviews', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id')->unsigned();
			$table->string('name', 125);
			$table->string('image', 256)->nullable();
			$table->string('title', 256);
			$table->integer('rating');
			$table->text('review');
			$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
		});
	}

	public function down()
	{
		Schema::drop('product_reviews');
	}
}
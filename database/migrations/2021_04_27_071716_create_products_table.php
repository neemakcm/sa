<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('type')->default('0');
			$table->integer('category_id')->unsigned();
			$table->string('sku', 125);
			$table->string('name', 256);
			$table->string('slug', 256)->nullable();
			$table->integer('price');
			$table->integer('offer_price');
			$table->text('description')->nullable();
			$table->integer('stock');
			$table->string('thumbnail', 256);
			$table->integer('parent_id')->unsigned()->default('0');
			$table->integer('is_active')->default('0');
			$table->integer('is_flagship')->default('0');
			$table->integer('is_new')->default('0');
			$table->longText('overview');
			$table->longText('specification');
			$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}
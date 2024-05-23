<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSupportOptionsTable extends Migration {

	public function up()
	{
		Schema::create('support_options', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 256);
			$table->string('icon', 256);
			$table->string('description');
			$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
		});
	}

	public function down()
	{
		Schema::drop('support_options');
	}
}
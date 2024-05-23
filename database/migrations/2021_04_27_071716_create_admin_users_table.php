<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminUsersTable extends Migration {

	public function up()
	{
		Schema::create('admin_users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 125);
			$table->string('email', 125);
			$table->string('password', 256);
			$table->integer('role_id')->unsigned();
			$table->integer('status')->default('1');
			$table->string('remember_token', 256)->nullable();
			$table->text('reset_key')->nullable();
			$table->datetime('reset_time')->nullable();
			$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('admin_users');
	}
}
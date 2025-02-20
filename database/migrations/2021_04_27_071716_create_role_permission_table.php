<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolePermissionTable extends Migration {

	public function up()
	{
		Schema::create('role_permission', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('role_id')->unsigned();
			$table->integer('permission_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('role_permission');
	}
}
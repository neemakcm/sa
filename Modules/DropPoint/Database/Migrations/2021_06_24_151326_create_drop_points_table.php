<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDropPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drop_points', function (Blueprint $table) {
            $table->increments('id');
			$table->string('title', 256);
			$table->text('description');
			$table->string('state', 125);
			$table->string('district', 125);
			$table->string('mobile', 125);
			$table->string('email', 125);
			$table->string('open_hour', 125);
			$table->string('location', 256);
			$table->string('latitude', 125);
			$table->string('longitude', 125);
			$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
		
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drop_points');
    }
}

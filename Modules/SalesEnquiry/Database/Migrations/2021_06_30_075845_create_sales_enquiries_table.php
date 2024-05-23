<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_enquiries', function (Blueprint $table) {
            $table->id();
			$table->string('enquiry_type', 125);
			$table->string('first_name', 125);
			$table->string('last_name', 125);
			$table->string('email', 125);
			$table->string('mobile', 125);
			$table->text('address_1')->nullable();
			$table->text('address_2')->nullable();
			$table->string('district', 125)->nullable();
			$table->string('state', 125)->nullable();
			$table->string('pincode', 125);
			$table->text('message')->nullable();
			$table->integer('status')->default('0');
			$table->text('description')->nullable();
			$table->text('invoice')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_enquiries');
    }
}

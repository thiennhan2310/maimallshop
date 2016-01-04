<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bills', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string("total");
			$table->integer("customer_id")->unsigned();
			$table->foreign("customer_id")->references("id")->on("customers")->onDelete("cascade");
			$table->tinyInteger("status");
			$table->tinyInteger("type"); //giao hang tan nha
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
		Schema::drop('bills');
	}

}

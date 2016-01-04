<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bill_details', function(Blueprint $table)
		{
			$table->integer("bill_id")->unsigned();
			$table->foreign("bill_id")->references("id")->on("bills")->onDelete("cascade");
			$table->integer("products_id")->unsigned();
			$table->foreign("products_id")->references("id")->on("products")->onDelete("cascade");
			$table->integer("price");
			$table->integer("amount");//so luong
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
		Schema::drop('bill_details');
	}

}

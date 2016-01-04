<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer("discount_id")->unsigned();
			$table->foreign("discount_id")->references("id")->on("discounts")->onDelete("cascade");
			$table->string("name");
			$table->string("alias");
			$table->integer("parent_id");
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
		Schema::drop('cates');
	}

}

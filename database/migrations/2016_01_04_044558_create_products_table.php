<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer("cate_id")->unsigned();
			$table->foreign("cate_id")->references("id")->on("cates")->onDelete("cascade");
			$table->string("name");
			$table->integer("price");
			$table->string("img1");
			$table->string("img2");
			$table->string("img3");
			$table->string("img4");
			$table->text("description");
			$table->string("brand");
			$table->string("size");
			$table->string("status");
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
		Schema::drop('products');
	}

}

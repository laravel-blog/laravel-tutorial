<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('images', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('path');
			$table->float('size', 10, 5);
			$table->float('width', 10, 5);
			$table->float('height', 10, 5);
			$table->float('ratio', 10, 5);
			$table->string('mime');
			$table->unsignedInteger('imageable_id');
			$table->string('imageable_type');
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
		Schema::drop('images');
	}

}

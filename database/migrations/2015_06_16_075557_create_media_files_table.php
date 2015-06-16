<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('media_files', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 255);
			$table->string('caption', 255);
			$table->string('link', 255);
			$table->string('thumbnail', 255);
			$table->string('type', 32);
			$table->integer('width');
			$table->integer('height');
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
		Schema::drop('media_files');
	}

}

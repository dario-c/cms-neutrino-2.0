<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextKeysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('text_keys', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->integer('text_category_id')->unsigned();
			$table->timestamps();

			$table->foreign('text_category_id')
				->references('id')
				->on('text_categories');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('text_keys');
	}

}

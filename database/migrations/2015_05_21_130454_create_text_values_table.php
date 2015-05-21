<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('text_values', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('value');
			$table->integer('text_key_id')->unsigned();
			$table->integer('text_language_id')->unsigned();
			$table->timestamps();

			$table->foreign('text_key_id')
				->references('id')
				->on('text_keys');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('text_values');
	}

}

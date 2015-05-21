<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelateLanguagesAndValues extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('text_values', function(Blueprint $table)
		{
			$table->foreign('text_language_id')
				->references('id')
				->on('text_languages');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('text_values', function(Blueprint $table)
		{
			//
		});
	}

}

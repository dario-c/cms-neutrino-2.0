<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostMetasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_meta', function(Blueprint $table)
		{
			$table->increments('id');
			$table->int('post_id')->unsigned();
			$table->string('key');
			$table->longText('value');
			$table->timestamps();
			
			$table->unique( array('post_id', 'key') );
			
			$table->foreign('post_id')
                  ->references('id')
                  ->on('posts');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('post_meta');
	}

}

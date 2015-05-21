<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->int('user_id')->unsigned();
			$table->int('state');
			$table->string('slug', 64);
			$table->string('title', 255);
			$table->string('type');
			$table->timestamps();
			
			$table->unique( array('slug', 'type') );
			
			$table->foreign('user_id')
                  ->references('id')
                  ->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts');
	}
}
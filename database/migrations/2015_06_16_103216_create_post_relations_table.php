<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostRelationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_relations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('relation');
			$table->string('post_type');
			$table->integer('post_id')->unsigned();
			$table->string('related_type');
			$table->integer('related_id')->unsigned();
			$table->timestamps();

			$table->foreign('post_id')
					->references('id')
					->on('posts')
					->onDelete('cascade');

			$table->foreign('related_id')
					->references('id')
					->on('posts')
					->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('post_relations');
	}

}

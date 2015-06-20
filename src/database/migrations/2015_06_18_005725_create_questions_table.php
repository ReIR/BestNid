<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('text',144);
			$table->timestamps();

			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')
				->references('id')
				->on('users');

				$table->integer('article_id')->unsigned();
				$table->foreign('article_id')
					->references('id')
					->on('articles');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('questions');
	}

}

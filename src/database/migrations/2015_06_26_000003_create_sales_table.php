<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sales', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();

			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')
				->references('id')
				->on('users');

			$table->integer('offer_id')->unsigned();
			$table->foreign('offer_id')
				->references('id')
				->on('offers');

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
		Schema::drop('sales');
	}

}

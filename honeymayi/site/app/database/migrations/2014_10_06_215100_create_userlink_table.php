<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserlinkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('userlink', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user1')->unsigned();
            $table->foreign('user1')->references('id')->on('users');
            $table->integer('user2')->unsigned();
            $table->foreign('user2')->references('id')->on('users');
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
		Schema::drop('userlink');
	}

}

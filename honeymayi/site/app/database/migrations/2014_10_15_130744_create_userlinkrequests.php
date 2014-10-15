<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserlinkrequests extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('userlinkrequests', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('you'); // The user initiating the request
            $table->integer('them'); // The user the request has been sent to.
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
		Schema::drop('userlinkrequests');
	}

}

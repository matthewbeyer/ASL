<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsAsked extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions_asked', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('questions');
            $table->integer('asker_id')->unsigned();
            $table->foreign('asker_id')->references('id')->on('users');
            $table->integer('askee_id')->unsigned();
            $table->foreign('askee_id')->references('id')->on('users');
            $table->string('message');
            $table->boolean('answer')->nullable();
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
		Schema::drop('questions_asked');
	}

}

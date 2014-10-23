<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuestionsAskedDropForeignKey extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('questions_asked', function(Blueprint $table)
		{
            $table->dropForeign('questions_asked_question_id_foreign');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('questions_asked', function(Blueprint $table)
		{
            $table->foreign('question_id')->references('id')->on('questions');
		});
	}

}

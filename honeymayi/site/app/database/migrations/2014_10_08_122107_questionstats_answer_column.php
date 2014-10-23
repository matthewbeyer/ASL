<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuestionstatsAnswerColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('questionstats', function(Blueprint $table)
        {
            // Drop the columns 'yes' and 'no'
            $table->dropColumn('yes');
            $table->dropColumn('no');
            // Add an answer column
            $table->boolean('answer');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('questionstats', function(Blueprint $table)
        {
            // Drop the answer column
            $table->dropColumn('answer');
            // Insert the columns 'yes' and 'no'
            $table->integer('yes');
            $table->integer('no');
        });

	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuestionsTableNullUserId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('questions', function(Blueprint $table)
        {
            $table->dropForeign('questions_user_id_foreign');
            DB::statement("ALTER TABLE questions MODIFY COLUMN user_id INT(10) UNSIGNED");
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('questions', function(Blueprint $table)
        {
            $table->dropForeign('questions_user_id_foreign');
            DB::statement("ALTER TABLE questions MODIFY COLUMN user_id INT(10) UNSIGNED");
            $table->foreign('user_id')->references('id')->on('users');
        });
	}

}

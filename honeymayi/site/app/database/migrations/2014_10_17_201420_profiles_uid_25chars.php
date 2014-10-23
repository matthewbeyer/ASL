<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProfilesUid25chars extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::statement("ALTER TABLE `profiles` CHANGE COLUMN `uid` `uid` bigint(25)UNSIGNED;");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::statement("ALTER TABLE `profiles` CHANGE COLUMN `uid` `uid` bigint(20)UNSIGNED;");
	}

}

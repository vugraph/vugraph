<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->unsignedInteger('auth_player')->nullable();
			$table->foreign('auth_player')->references('id')->on('players')
				->onDelete('SET NULL')->onUpdate('SET NULL');
			$table->unsignedInteger('auth_club')->nullable();
			$table->foreign('auth_club')->references('id')->on('clubs')
				->onDelete('SET NULL')->onUpdate('SET NULL');
			$table->unsignedInteger('auth_city')->nullable();
			$table->foreign('auth_city')->references('id')->on('cities')
				->onDelete('SET NULL')->onUpdate('SET NULL');
			$table->unsignedInteger('auth_region')->nullable();
			$table->foreign('auth_region')->references('id')->on('regions')
				->onDelete('SET NULL')->onUpdate('SET NULL');
			$table->boolean('auth_licence')->default(false);
			$table->boolean('auth_admin')->default(false);
			$table->string('old_club_username')->default('');
			$table->string('old_city_username')->default('');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropForeign('users_auth_player_foreign');
			$table->dropColumn('auth_player');
			$table->dropForeign('users_auth_club_foreign');
			$table->dropColumn('auth_club');
			$table->dropForeign('users_auth_city_foreign');
			$table->dropColumn('auth_city');
			$table->dropForeign('users_auth_region_foreign');
			$table->dropColumn('auth_region');
			$table->dropColumn('auth_admin');
			$table->dropColumn('auth_licence');
			$table->dropColumn('old_username');
		});
	}

}
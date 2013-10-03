<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrivilegesToUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->unsignedInteger('club_id')->nullable();
			$table->foreign('club_id')->references('id')->on('clubs')
				->onDelete('SET NULL')
				->onUpdate('SET NULL');
			$table->unsignedInteger('city_id')->nullable();
			$table->foreign('city_id')->references('id')->on('cities')
				->onDelete('SET NULL')
				->onUpdate('SET NULL');
			$table->unsignedInteger('region_id')->nullable();
			$table->foreign('region_id')->references('id')->on('regions')
				->onDelete('SET NULL')
				->onUpdate('SET NULL');
			$table->boolean('is_admin')->default(false);
			$table->boolean('is_licenceadmin')->default(false);
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
			$table->dropForeign('users_club_id_foreign');
			$table->dropColumn('club_id');
			$table->dropForeign('users_city_id_foreign');
			$table->dropColumn('city_id');
			$table->dropForeign('users_region_id_foreign');
			$table->dropColumn('region_id');
			$table->dropColumn('is_admin');
			$table->dropColumn('is_licenceadmin');
		});
	}

}
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clubs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('city_id');
			$table->foreign('city_id')->references('id')->on('cities');
			$table->string('name', 60)->default('')->unique();
			$table->string('shortname', 15)->default('');
			$table->string('address', 240)->default('');
			$table->string('phone', 60)->default('');
			$table->string('fax', 60)->default('');
			$table->string('email', 120)->default('');
			$table->string('website', 120)->default('');
			// TODO: Create club_directors relation table (one to many)
//			$table->string('director1', 60)->default('');
//			$table->string('director2', 60)->default('');
			$table->timestamps();
			$table->softDeletes();
			// TODO: Create the club_users relation table (one to many)
			$table->unsignedInteger('user_id')->nullable();
//			$table->foreign('user_id')
//				->references('id')->on('users')
//				->onDelete('SET NULL')
//				->onUpdate('SET NULL');
			$table->unsignedInteger('old_id')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('clubs');
	}

}

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
			$table->string('name')->default('')->unique();
			$table->string('shortname', 15)->default('');
			$table->string('address')->default('');
			$table->string('phone')->default('');
			$table->string('fax')->default('');
			$table->string('email')->nullable()->default(null)->unique();
			$table->string('website')->default('');
			$table->unsignedInteger('old_id')->nullable()->default(null)->unique();
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

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTitlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('titles', function(Blueprint $table)
		{
			$table->unsignedInteger('id');
			$table->primary('id');
			$table->string('name')->default('')->unique();
			$table->unsignedInteger('min_gold_plus')->default(0);
			$table->unsignedInteger('min_red_plus')->default(0);
			$table->unsignedInteger('min_green_plus')->default(0);
			$table->unsignedInteger('min_online_plus')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('titles');
	}

}

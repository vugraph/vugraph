<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('players', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('licence_no')->unique();
			$table->string('name')->default('');
			$table->string('first_name')->default('');
			$table->string('last_name')->default('');
			$table->string('father')->default('');
			$table->string('mother')->default('');
			$table->unsignedInteger('city_id')->nullable()->default(null);
			$table->foreign('city_id')->references('id')->on('cities');
			$table->date('birth_date')->nullable()->default(null);
			$table->string('birth_place')->default('');
			$table->unsignedInteger('education_status')->nullable()->default(null);
			// 1: Okur-yazar, 2: İlköğretim, 3: Lise, 4: Yüksek Okul, 5: Üniversite, 6: Yüksek Lisans, 7: Doktora
			$table->unsignedInteger('club_id')->nullable()->default(null);
			$table->foreign('club_id')->references('id')->on('clubs')
				->onDelete('SET NULL')->onUpdate('SET NULL');
			$table->enum('gender', array('M', 'F'))->nullable()->default(null);
			$table->unsignedInteger('approve_years')->default(0);
			$table->string('email')->nullable()->default(null)->unique();
			$table->unsignedBigInteger('ssn')->nullable()->default(null)->unique();
			$table->boolean('ssn_verified')->nullable()->default(null);
			$table->string('bbo')->nullable()->default(null)->unique();
			$table->string('address')->default('');
			$table->unsignedInteger('postal_code')->nullable()->default(null);
			$table->string('phone')->default('');
			$table->unsignedInteger('title_id')->nullable()->default(null);
			$table->foreign('title_id')->references('id')->on('titles')
				->onDelete('SET NULL')->onUpdate('SET NULL');
			// 1: Kulüp Ustası, 2: Bölge Ustası, 3: Bronz Usta, 4: Gümüş Usta, 5: Altın Usta, 6: Bronz Büyük Usta, 7: Gümüş Büyük Usta, 8: Altın Büyük Usta
			$table->decimal('mp_sum')->default(0);
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
		Schema::drop('players');
	}

}

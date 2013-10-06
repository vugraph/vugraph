<?php

class TitlesTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('titles')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');
		DB::table('titles')->insert(array('id' => 1, 'name' => 'Kulüp Ustası'));
		DB::table('titles')->insert(array('id' => 2, 'name' => 'Bölge Ustası'));
		DB::table('titles')->insert(array('id' => 3, 'name' => 'Bronz Usta'));
		DB::table('titles')->insert(array('id' => 4, 'name' => 'Gümüş Usta'));
		DB::table('titles')->insert(array('id' => 5, 'name' => 'Altın Usta'));
		DB::table('titles')->insert(array('id' => 6, 'name' => 'Bronz Büyük Usta'));
		DB::table('titles')->insert(array('id' => 7, 'name' => 'Gümüş Büyük Usta'));
		DB::table('titles')->insert(array('id' => 8, 'name' => 'Altın Büyük Usta'));
	}

}

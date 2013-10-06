<?php

class RegionsTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('regions')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');
		
		DB::table('regions')->insert(array('id' => 1, 'name' => 'Marmara'));
		DB::table('regions')->insert(array('id' => 2, 'name' => 'Güney Marmara'));
		DB::table('regions')->insert(array('id' => 3, 'name' => 'Trakya'));
		DB::table('regions')->insert(array('id' => 4, 'name' => 'Ege'));
		DB::table('regions')->insert(array('id' => 5, 'name' => 'Batı Akdeniz'));
		DB::table('regions')->insert(array('id' => 6, 'name' => 'Çukurova'));
		DB::table('regions')->insert(array('id' => 7, 'name' => 'İç Anadolu'));
		DB::table('regions')->insert(array('id' => 8, 'name' => 'Batı Karadeniz'));
		DB::table('regions')->insert(array('id' => 9, 'name' => 'Doğu Karadeniz'));
		DB::table('regions')->insert(array('id' => 10, 'name' => 'Doğu ve Güneydoğu Anadolu'));
	}

}

<?php

use Odeva\Masterpoint\Model\Region;

class RegionsTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('regions')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');
		DB::table('regions')->insert(array('name' => 'Marmara'));
		DB::table('regions')->insert(array('name' => 'Güney Marmara'));
		DB::table('regions')->insert(array('name' => 'Trakya'));
		DB::table('regions')->insert(array('name' => 'Ege'));
		DB::table('regions')->insert(array('name' => 'Batı Akdeniz'));
		DB::table('regions')->insert(array('name' => 'Çukurova'));
		DB::table('regions')->insert(array('name' => 'İç Anadolu'));
		DB::table('regions')->insert(array('name' => 'Batı Karadeniz'));
		DB::table('regions')->insert(array('name' => 'Doğu Karadeniz'));
		DB::table('regions')->insert(array('name' => 'Doğu ve Güneydoğu Anadolu'));
	}

}

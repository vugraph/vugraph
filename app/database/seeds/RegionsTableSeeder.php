<?php

use Odeva\Masterpoint\Model\Region;

class RegionsTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('regions')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');
		Region::create(array('name' => 'Marmara'));
		Region::create(array('name' => 'Güney Marmara'));
		Region::create(array('name' => 'Trakya'));
		Region::create(array('name' => 'Ege'));
		Region::create(array('name' => 'Batı Akdeniz'));
		Region::create(array('name' => 'Çukurova'));
		Region::create(array('name' => 'İç Anadolu'));
		Region::create(array('name' => 'Batı Karadeniz'));
		Region::create(array('name' => 'Doğu Karadeniz'));
		Region::create(array('name' => 'Doğu ve Güneydoğu Anadolu'));
	}

}

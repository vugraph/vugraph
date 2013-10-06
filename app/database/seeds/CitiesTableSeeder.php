<?php

class CitiesTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('cities')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');
		$cities_raw = explode("\n", file_get_contents(app_path().'/database/seeds/cities.txt'));
		foreach($cities_raw as $city_raw) {
			if (trim($city_raw) == '') continue;
			if (!preg_match("/([^\t]+)\t([^\t]+)\t([^\t]+)\t(.*)/", $city_raw, $matches)) die('match error on cities.txt');
			DB::table('cities')->insert(array(
				'id' => intval($matches[1]),
				'region_id' => intval($matches[3]),
				'name' => trim($matches[2])
			));
		}
	}

}

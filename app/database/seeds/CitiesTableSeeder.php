<?php

use Odeva\Masterpoint\Model\City;

class CitiesTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('cities')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');
		$cities_raw = explode("\n", file_get_contents(app_path().'/database/seeds/cities.txt'));
		foreach($cities_raw as $city_raw) {
			if (trim($city_raw) == '') continue;
			if (!preg_match("/([^\t]+)\t([^\t]+)\t([^\t]+)\t(.*)/", $city_raw, $matches)) return('match error on line'. $city_raw.' of cities.txt');
			DB::table('cities')->insert(array(
				'id' => intval($matches[1]),
				'region_id' => intval($matches[3], 10),
				'name' => trim($matches[2])
//				'code' => trim($matches[4])
			));
		}
		foreach(DB::table('cities')->get(array('id')) as $city) {
			$region = DB::connection('tbricfed')->select('SELECT authorizedUser FROM regions WHERE id='.$city->id);
			if (!empty($region) && !empty($region[0]->authorizedUser)) {
				try {
					$usr = DB::table('users')->where('old_username', 'like', '%\''.$region[0]->authorizedUser.'\'%')->first(array('id'));
					if (!empty($usr)) {
						$user = Sentry::findUserById($usr->id);
						$user->city_id = $city->id;
						$user->save();
					} else {
						$this->command->info('skipped unexisting region username: '.$region[0]->authorizedUser);
					}
				} catch (\Exception $e) {
					die($e->getMessage());
				}
			}
		}
	}

}

<?php

class ClubsTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('clubs')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');
		$clubs = DB::connection('tbricfed')->select('SELECT * FROM clubs ORDER BY city,id');
		foreach($clubs as $club) {
			$userid = null;
			$clubid = DB::table('clubs')->insertGetId(array(
				'city_id' => intval($club->city, 10),
				'name' => mb_convert_encoding($club->name, 'UTF-8', 'ISO-8859-9'),
				'shortname' => mb_convert_encoding($club->shortname, 'UTF-8', 'ISO-8859-9'),
				'address' => mb_convert_encoding($club->address, 'UTF-8', 'ISO-8859-9'),
				'phone' => mb_convert_encoding($club->phone, 'UTF-8', 'ISO-8859-9'),
				'fax' => mb_convert_encoding($club->fax, 'UTF-8', 'ISO-8859-9'),
				'email' => mb_convert_encoding($club->email, 'UTF-8', 'ISO-8859-9'),
				'website' => mb_convert_encoding($club->http, 'UTF-8', 'ISO-8859-9'),
//				'director1' => mb_convert_encoding($club->dir1, 'UTF-8', 'ISO-8859-9'),
//				'director2' => mb_convert_encoding($club->dir2, 'UTF-8', 'ISO-8859-9'),
				'old_id' => $club->id
			));
			if (!empty($club->authorizedUser)) {
				try {
					$usr = DB::table('users')->where('old_username', 'like', '%\''.$club->authorizedUser.'\'%')->first(array('id'));
					if (!empty($usr)) {
						$user = Sentry::findUserById($usr->id);
						$user->club_id = $clubid;
						$user->save();
					} else {
						$this->command->info('skipped unexisting club username: '.$club->authorizedUser);
					}
				} catch (\Exception $e) {
					die($e->getMessage());
				}
			}
		}
	}

}

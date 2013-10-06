<?php

class ClubsTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('clubs')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');
		$clubs = DB::connection('tbricfed')->select('SELECT * FROM clubs ORDER BY city,id');
		foreach($clubs as $club) {
			$orig_email = $club->email = mb_convert_encoding($club->email, 'UTF-8', 'ISO-8859-9');
			$club->email = Str::sanitizeEmail($club->email);
			if ($orig_email != $club->email) $this->command->info('Old id:'.$club->id.'\'s email '.$orig_email.' => '.$club->email);
			if (empty($club->email)) $club->email = null;
			$orig_http = $club->http = mb_convert_encoding($club->http, 'UTF-8', 'ISO-8859-9');
			$club->http = Str::sanitizeUrl($club->http);
			if ($orig_http != $club->http && 'http://'.$orig_http != $club->http) $this->command->info('Old id:'.$club->id.'\'s website '.$orig_http.' => '.$club->http);
			DB::table('clubs')->insert(array(
				'city_id' => $club->city,
				'name' => trim(mb_convert_encoding($club->name, 'UTF-8', 'ISO-8859-9')),
				'shortname' => trim(mb_convert_encoding($club->shortname, 'UTF-8', 'ISO-8859-9')),
				'address' => trim(mb_convert_encoding($club->address, 'UTF-8', 'ISO-8859-9')),
				'phone' => trim(mb_convert_encoding($club->phone, 'UTF-8', 'ISO-8859-9')),
				'fax' => trim(mb_convert_encoding($club->fax, 'UTF-8', 'ISO-8859-9')),
				'email' => $club->email,
				'website' => $club->http,
				'old_id' => $club->id
			));
		}
	}

}

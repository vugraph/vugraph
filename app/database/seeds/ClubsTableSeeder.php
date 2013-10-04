<?php

use Odeva\Masterpoint\Model\Club;

class ClubsTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('clubs')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');
		$clubs = DB::connection('tbricfed')->select('SELECT * FROM clubs ORDER BY city,id');
		foreach($clubs as $club) {
			$newclub = Club::create(array(
				'city_id' => $club->city,
				'name' => trim(mb_convert_encoding($club->name, 'UTF-8', 'ISO-8859-9')),
				'shortname' => trim(mb_convert_encoding($club->shortname, 'UTF-8', 'ISO-8859-9')),
				'address' => trim(mb_convert_encoding($club->address, 'UTF-8', 'ISO-8859-9')),
				'phone' => trim(mb_convert_encoding($club->phone, 'UTF-8', 'ISO-8859-9')),
				'fax' => trim(mb_convert_encoding($club->fax, 'UTF-8', 'ISO-8859-9')),
				'email' => trim(mb_convert_encoding($club->email, 'UTF-8', 'ISO-8859-9')),
				'website' => trim(mb_convert_encoding($club->http, 'UTF-8', 'ISO-8859-9')),
				'old_id' => $club->id
			));
		}
	}

}

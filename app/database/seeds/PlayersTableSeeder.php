<?php

class PlayersTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('players')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');
		$players = DB::connection('tbricfed')->select('SELECT * FROM players ORDER BY id');
		foreach($players as $player) {
			if ($player->city > 81) $player->city = null;
			if ($player->clubId) {
				$club = DB::table('clubs')->select('id')->where('old_id', '=', $player->clubId)->first();
				if (empty($club)) {
					$this->command->info('Old Club Id ('.$player->clubId.') could not be found for player_id: '.$player->id);
					$player->clubId = null;
				} else $player->clubId = $club->id;
			}
			$orig_email = $player->email = mb_convert_encoding($player->email, 'UTF-8', 'ISO-8859-9');
			$player->email = strtolower(Str::sanitizeEmail($player->email));
			if ($orig_email != $player->email) $this->command->info(sprintf('%06s', $player->licenceNo).': email '.$orig_email.' => '.$player->email);
			if (empty($player->email)) $player->email = null;
			DB::table('players')->insert(array(
				'licence_no' => $player->licenceNo,
				'name' => trim(mb_convert_encoding($player->nameInUse, 'UTF-8', 'ISO-8859-9')),
				'first_name' => trim(mb_convert_encoding($player->name, 'UTF-8', 'ISO-8859-9')),
				'last_name' => trim(mb_convert_encoding($player->surname, 'UTF-8', 'ISO-8859-9')),
				'father' => trim(mb_convert_encoding($player->father, 'UTF-8', 'ISO-8859-9')),
				'mother' => trim(mb_convert_encoding($player->mother, 'UTF-8', 'ISO-8859-9')),
				'city_id' => $player->city ?: null,
				'birth_date' => $player->birthDate,
				'birth_place' => trim(mb_convert_encoding($player->birthPlace, 'UTF-8', 'ISO-8859-9')),
				'education_status' => $player->educationStatus,
				'club_id' => $player->clubId ?: null,
				'gender' => trim($player->gender) ?: null,
				'approve_years' => $player->approveYears,
				'email' => $player->email,
				'ssn' => $player->ssn ?: null,
				'ssn_verified' => $player->verified,
				'address' => trim(mb_convert_encoding($player->address, 'UTF-8', 'ISO-8859-9')),
				'postal_code' => $player->postalCode ?: null,
				'phone' => mb_convert_encoding(trim(trim(trim($player->phone).' '.trim($player->workPhone)).' '.trim($player->mobile)), 'UTF-8', 'ISO-8859-9'),
				'title_id' => $player->title ?: null,
				'old_id' => $player->id
			));
		}
	}

}
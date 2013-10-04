<?php

use Odeva\Masterpoint\Model\Player;

class PlayersTableSeeder extends Seeder {

	public function run()
	{
/* Handled Duplicate Licence Numbers:
 * 050015 => 050019
 * 330093 => 330225
 * 330050 => 330228
 * 413026 ve 413027 aynı TC Kimlik noya sahipler ama farklı kişiler. Birisinden birinin TC Kimlik numarası yanlış.
 * 350398 => 341804
 * 260172 => 430032
 * 341818 => 341601
 * 350928 => 351006
 */
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('players')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');
//		$duplicate = DB::connection('tbricfed')->select('
//			SELECT p1.ssn, p1.id as id1, p2.id as id2, p1.licenceNo as lic1, p2.licenceNo as lic2
//			FROM players p1
//				JOIN players p2 ON (p1.ssn=p2.ssn AND p1.id>p2.id)
//		');
//		SELECT ssn,count(*) FROM players WHERE ssn IS NOT NULL AND ssn<>0
//			and ssn<>11111111111 and ssn<>22222222222 and ssn<>33333333333 and ssn<>44444444444 and ssn<>55555555555
//			and ssn<>66666666666 and ssn<>77777777777 and ssn<>88888888888 and ssn<>99999999999
//			group by ssn HAVING count(*)>1
//			ORDER BY count(*) desc, ssn
		$players = DB::connection('tbricfed')->select('SELECT * FROM players ORDER BY id');
		$p = new Player;
		$invalidSsnCount = 0;
		foreach($players as $player) {
			if ($player->city > 81) $player->city = null;
			if ($player->ssn && !$p->checkSSN($player->ssn)) {
				$invalidSsnCount++;
				$player->ssn = null;
			}
			if ($player->clubId) {
				$club = DB::table('clubs')->select('id')->where('old_id', '=', $player->clubId)->first();
				if (empty($club)) {
					$this->command->info('Old Club Id ('.$player->clubId.') could not be found for player_id: '.$player->id);
					$player->clubId = null;
				} else $player->clubId = $club->id;
			}
			if (!is_null($player->birthDate) && substr($player->birthDate, 0, 1) != '1' && substr($player->birthDate, 0, 1) != '2') $player->birthDate = null;
			$newplayer = Player::create(array(
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
				'email' => trim(mb_convert_encoding($player->email, 'UTF-8', 'ISO-8859-9')),
				'ssn' => $player->ssn ?: null,
				'address' => trim(mb_convert_encoding($player->address, 'UTF-8', 'ISO-8859-9')),
				'postal_code' => $player->postalCode ?: null,
				'phone' => mb_convert_encoding(trim(trim(trim($player->phone).' '.trim($player->workPhone)).' '.trim($player->mobile)), 'UTF-8', 'ISO-8859-9'),
				'title_id' => $player->title ?: null,
				'old_id' => $player->id
			));
		}
		if ($invalidSsnCount) $this->command->info($invalidSsnCount.' invalid SSN numbers were set to null');
	}

}
<?php
/*
Setting SSN to null that is used by verified player: 11324289606-416315
Setting SSN to null that is used by verified player: 42707108436-413869
Setting SSN to null that is used by verified player: 42946103100-416898
Setting SSN to null that is used by verified player: 48283674204-413027
Setting SSN to null that is used by verified player: 58111592822-416286
Auto Joined: 10094555188 340193 => 343024 similarity is 110.9%
Auto Joined: 10208029338 180003 => 180005 similarity is 113.4%
Auto Joined: 10279179826 160108 => 342594 similarity is 103.3%
Auto Joined: 11029073340 063790 => 063792 similarity is 96.6%
Auto Joined: 11224072346 350398 => 341804 similarity is 94.5%
Auto Joined: 11857125976 063789 => 063794 similarity is 75.3%
Auto Joined: 12521284814 310317 => 310319 similarity is 97.5%
Auto Joined: 12662071410 590292 => 590295 similarity is 113.5%
Auto Joined: 12883729404 063863 => 063865 similarity is 103.4%
Auto Joined: 13001768084 354017 => 354046 similarity is 89.3%
Auto Joined: 13142358052 063740 => 063744 similarity is 110.9%
Auto Joined: 15167392172 343032 => 343033 similarity is 97.4%
Auto Joined: 15364012248 063889 => 063890 similarity is 104.9%
Auto Joined: 16948957436 310315 => 063918 similarity is 95.5%
Auto Joined: 17002401162 050018 => 050020 similarity is 105.8%
Auto Joined: 17552354192 350832 => 353862 similarity is 77.9%
Auto Joined: 17591277728 342739 => 342735 similarity is 82.1%
Auto Joined: 18592348448 050016 => 050022 similarity is 107.5%
Auto Joined: 18800102954 330093 => 330225 similarity is 82.1%
Auto Joined: 21391972868 240012 => 550159 similarity is 77.4%
Auto Joined: 23132621202 342852 => 343028 similarity is 106.7%
Auto Joined: 23791576202 180004 => 180007 similarity is 103.1%
Auto Joined: 25279141674 050017 => 050021 similarity is 106.4%
Auto Joined: 25699016132 440118 => 342936 similarity is 100.8%
Auto Joined: 25850506168 390134 => 600005 similarity is 104.5%
Auto Joined: 27004024986 063861 => 030099 similarity is 103.1%
Auto Joined: 27763797862 140030 => 140037 similarity is 86.8%
Auto Joined: 27955389806 342943 => 342967 similarity is 89.2%
Auto Joined: 28726026722 050019 => 050015 similarity is 105.1%
Auto Joined: 28774674678 330050 => 330228 similarity is 70.4%
Auto Joined: 29161506268 210128 => 210129 similarity is 93.8%
Auto Joined: 29407388900 342920 => 342948 similarity is 110.1%
Auto Joined: 30616916822 351006 => 350928 similarity is 72.4%
Auto Joined: 32518041206 100173 => 350393 similarity is 103.3%
Auto Joined: 32875004920 090296 => 353859 similarity is 84.4%
Auto Joined: 33071228646 550143 => 550162 similarity is 104.6%
Auto Joined: 33448814588 341818 => 341601 similarity is 82.8%
Auto Joined: 34705729232 353919 => 353924 similarity is 92.9%
Auto Joined: 36694742124 350665 => 353948 similarity is 85.1%
Auto Joined: 37153060544 063912 => 063917 similarity is 106.4%
Auto Joined: 37843107788 180002 => 180006 similarity is 118.2%
Auto Joined: 37864677086 353984 => 353888 similarity is 104.8%
Auto Joined: 39088806518 260172 => 430032 similarity is 92.4%
Auto Joined: 39403337260 063919 => 063925 similarity is 107.2%
Auto Joined: 41053333776 200113 => 310038 similarity is 76.0%
Auto Joined: 49177589864 480543 => 470041 similarity is 90.2%
Auto Joined: 52336171008 540150 => 343041 similarity is 92.5%
Auto Joined: 53374616230 410047 => 610043 similarity is 66.2%
Auto Joined: 54541204588 170070 => 170100 similarity is 93.9%
Auto Joined: 58990015658 370080 => 370081 similarity is 100.1%
Auto Joined: 59167333872 063780 => 063867 similarity is 102.0%
Auto Joined: 63325167216 520099 => 520097 similarity is 98.6%
Auto Joined: 66352309284 342853 => 342954 similarity is 91.9%
Auto Joined: 71509004578 060252 => 670213 similarity is 99.9%
*/
use Odeva\Masterpoint\Model\Player;

class TbricfedDbFixer extends Seeder {

	public function run()
	{
		DB::setDefaultConnection('tbricfed');

		/* Fix names of two clubs (DSİ SPOR KULÜBÜ) on different cities which breaks name uniqueness */
		DB::update('UPDATE clubs SET name=concat(name, \' EDIRNE\') WHERE city=22 AND name LIKE \'DS_ SPOR KUL_B_\'');
		DB::update('UPDATE clubs SET name=concat(name, \' BALIKESIR\') WHERE city=10 AND name LIKE \'DS_ SPOR KUL_B_\'');

		/* Fix some emails */
		DB::update('UPDATE clubs SET email=\'balikesirbric@mynet.com\' WHERE id=37 AND email LIKE \'balikesirbric@mynet.com%\'');
		DB::update('UPDATE clubs SET email=\'rifatdogan55@hotmail.com\' WHERE id=83 AND email LIKE \'rifatdogan55hotmail.com\'');
		DB::update('UPDATE players SET email=\'nilufer@safe-mail.net\' WHERE id=305 AND email LIKE \'%fer@safe_mail.net\'');
		DB::update('UPDATE players SET email=\'muratkaplan2000@yahoo.com\' WHERE id=3204 AND email LIKE \'muratkaplan2000qyahoo.com\'');
		DB::update('UPDATE players SET email=\'pandacocukevi@mynet.com\' WHERE id=3483 AND email LIKE \'pandacocukevi.mynet.com\'');
		DB::update('UPDATE players SET email=\'ilker_tirik@hotmail.com\' WHERE id=3774 AND email LIKE \'ilker_tirik@hotmai\'');
		DB::update('UPDATE players SET email=\'osmangumus@vestel.com.tr\' WHERE id=4222 AND email LIKE \'osmangumus@vestel:com:tr\'');
		DB::update('UPDATE players SET email=\'ibaskaya58@gmail.com\' WHERE id=411896 AND email LIKE \'ibaskaya58qgmail.com\'');
		DB::update('UPDATE players SET email=\'saim_gunay@unilever.com\' WHERE id=412269 AND email LIKE \'saim_gunay@u%nilever.com\'');
		DB::update('UPDATE players SET email=\'murat_kahyaoglu@bistron.com\' WHERE id=412307 AND email LIKE \'murat_kahyao%lu.bistron.com\'');
		DB::update('UPDATE players SET email=\'er_ay@tnn.net\' WHERE id=412414 AND email LIKE \'er_ay@tnn\'');
		DB::update('UPDATE players SET email=\'bekirx19@hotmail.com\' WHERE id=413083 AND email LIKE \'bekirx19qhotmail.com\'');
		DB::update('UPDATE players SET email=\'avcomlekcioglu@mynet.com\' WHERE id=413358 AND email LIKE \'avcomlekcioglu.mynet.com\'');
		DB::update('UPDATE players SET email=\'pinar.sarioz@boun.edu.tr\' WHERE id=413360 AND email LIKE \'pinar.sarioz.boun.edu.tr\'');
		DB::update('UPDATE players SET email=\'coskun.surgevil@emo.org.tr\' WHERE id=413426 AND email LIKE \'coskun.surgevil.@emo.org.tr\'');
		DB::update('UPDATE players SET email=\'ferhanilk@gmail.com\' WHERE id=413520 AND email LIKE \'ferhanilk@gmai\'');
		DB::update('UPDATE players SET email=\'moguz1966@hotmail.com\' WHERE id=414194 AND email LIKE \'moguz@1966@hotmail.com\'');
		DB::update('UPDATE players SET email=\'murat@atalik.com\' WHERE id=414367 AND email LIKE \'murat@atalik.com.\'');
		DB::update('UPDATE players SET email=\'ayyildiz_eros@yahoo.com\' WHERE id=414468 AND email LIKE \'ayyildiz_erosqyahoo.com\'');
		DB::update('UPDATE players SET email=\'mcyanik@yahoo.com\' WHERE id=414519 AND email LIKE \'mcyanikqyahoo.com\'');
		DB::update('UPDATE players SET email=\'u.kethuda@hotmail.com\' WHERE id=414638 AND email LIKE \'u.kethuda.@hotmail.com\'');
		DB::update('UPDATE players SET email=\'aakarahan@yahoo.com\' WHERE id=414770 AND email LIKE \'aakarahanqyahoo.com\'');
		DB::update('UPDATE players SET email=\'uzun65@ttnet.net.tr\' WHERE id=414852 AND email LIKE \'uzun65qttnet.net.tr\'');
		DB::update('UPDATE players SET email=\'sibelturken@gmail.com\' WHERE id=414864 AND email LIKE \'sibelturken@gma\'');
		DB::update('UPDATE players SET email=\'gsaribas@hotmail.com\' WHERE id=415090 AND email LIKE \'gsaribas@hotmail:com\'');
		DB::update('UPDATE players SET email=\'idnoglu@tr.net\' WHERE id=415145 AND email LIKE \'idnoglu@trnet.\'');
		DB::update('UPDATE players SET email=\'sahan_89_2006@hotmail.com\' WHERE id=415479 AND email LIKE \'sahan_89_2006hotmail.com\'');
		DB::update('UPDATE players SET email=\'tubar2005@hotmail.com\' WHERE id=415664 AND email LIKE \'tubar@2005@hotmail.com\'');
		DB::update('UPDATE players SET email=\'bflalparslan@gmail.com\' WHERE id=415771 AND email LIKE \'bflalparslan@gmail\'');
		DB::update('UPDATE players SET email=\'orhanoguz@hotmail.com\' WHERE id=417735 AND email LIKE \'orhanoguz@hotmail.com.\'');
		DB::update('UPDATE players SET email=\'info@damlakuruyemis.com.tr\' WHERE id=418026 AND email LIKE \'infodamlakuruyemi%.com %tr\'');
		DB::update('UPDATE players SET email=\'m.necati.s@hotmail.com\' WHERE id=418141 AND email LIKE \'m.necati.s.@hotmail.com\'');
		DB::update('UPDATE players SET email=\'fatihcanga@yahoo.com\' WHERE id=413341 AND email LIKE \'fatihcanga@yahoo.co%\'');
		DB::update('UPDATE players SET email=\'zaferb@kou.edu.tr\' WHERE id=415050 AND email LIKE \'zaferb@kou.edu.re\'');
		DB::update('UPDATE players SET email=\'ganidogru@gmail.com\' WHERE id=417213 AND email LIKE \'gan,dogru@gmail.com\'');
		DB::update('UPDATE authorizedUsers SET eMail=\'nakibulut@yahoo.com\', `name`=\'Naki Bulut\' WHERE username=\'muglaemsk\' AND email LIKE \'onererhan@yahoo.com,nakibulut@yahoo.com\'');
		// Set duplicate email addresses that are used by other players to null
		DB::update('UPDATE players SET email=\'\' WHERE id IN (4892,2174,4574,5079,4412,412727,412980) AND email LIKE \'abk@anadolubric.com\'');
		DB::update('UPDATE players SET email=\'\' WHERE id IN (418539,418537,418538,418536,418503) AND email LIKE \'leventozgul@gmail.com\'');
		DB::update('UPDATE players SET email=\'\' WHERE id=418800 AND email LIKE \'ntalatd@hotmail.com\'');
		DB::update('UPDATE players SET email=\'\' WHERE id=652 AND email LIKE \'mehmet.sabuncu@sim.net.tr\'');
		DB::update('UPDATE players SET email=\'\' WHERE id=2132 AND email LIKE \'eabacioglu@isnet.net.tr\'');
		DB::update('UPDATE players SET email=\'\' WHERE id=412840 AND email LIKE \'sudebil_ilhan@yahoo.com\'');
		DB::update('UPDATE players SET email=\'\' WHERE id=2146 AND email LIKE \'erkyayin@ttnet.net.tr\'');
		DB::update('UPDATE players SET email=\'\' WHERE id=418540 AND email LIKE \'levent@cayyolu.org\'');
		DB::update('UPDATE players SET email=\'\' WHERE id=4979 AND email LIKE \'ydagdeviren@soziz.com\'');
		DB::update('UPDATE players SET email=\'\' WHERE id=412797 AND email LIKE \'devrekbrickulubu@yahoo.com\'');
		DB::update('UPDATE players SET email=\'\' WHERE id=412903 AND email LIKE \'diyar@ugurdershanesi.com.tr\''); // randomly chosen
		DB::update('UPDATE players SET email=\'\' WHERE id=412374 AND email LIKE \'sadiakcaoglu@mynet.com\'');
		DB::update('UPDATE players SET email=\'\' WHERE id=412638 AND email LIKE \'abtunay@hotmail.com\'');
		DB::update('UPDATE players SET email=\'\' WHERE id=2885 AND email LIKE \'cagri@doruk.net.tr\'');
		DB::update('UPDATE players SET email=\'\' WHERE id=1843 AND email LIKE \'denizci@omu.edu.tr\'');
		DB::update('UPDATE players SET email=\'\' WHERE id=289 AND email LIKE \'stuzcu@superonline.com\'');
		DB::update('UPDATE players SET email=\'\' WHERE id=440 AND email LIKE \'cynthia@ttnet.net.tr\'');
		DB::update('UPDATE players SET email=\'\' WHERE id=3873 AND email LIKE \'karberk@ogu.edu.tr\'');
		DB::update('UPDATE players SET email=\'\' WHERE id=4946 AND email LIKE \'kamgozen@onko.com.tr\'');
		DB::update('UPDATE players SET email=\'\' WHERE id=418652 AND email LIKE \'gunkuttolga@hotmail.com\'');
		DB::update('UPDATE players SET email=\'\' WHERE id=414261 AND email LIKE \'ozhabesymm@ttnet.net.tr\'');
		DB::update('UPDATE players SET email=\'\' WHERE id=3511 AND email LIKE \'alkemi@kablonet.com.tr\'');
//		DB::update('UPDATE players SET email=\'\' WHERE id= AND email LIKE \'\'');
		DB::update('UPDATE clubs SET email=\'\' WHERE id=127 AND email LIKE \'birolarslan43@hotmail.com\'');
		DB::update('UPDATE clubs SET email=\'\' WHERE id=97 AND email LIKE \'gzeren@sisecam.com.tr\'');
		DB::update('UPDATE clubs SET email=\'\' WHERE id=74 AND email LIKE \'marmarisbrickulubu@ttmail.com\'');
		DB::update('UPDATE clubs SET email=\'\' WHERE id IN (174,237) AND email LIKE \'mehmet.varavir@gmail.com\'');
//		DB::update('UPDATE clubs SET email=\'\' WHERE id=  AND email LIKE \'\'');

		/* Add verified column to players table if it does not exist and check SSN validness on all players */
		$verify_column = DB::select("SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='tbricfed_db' AND TABLE_NAME='players' AND COLUMN_NAME='verified'");
		if (empty($verify_column)) {
			if (DB::statement('ALTER TABLE  `players` ADD  `verified` BOOLEAN NULL DEFAULT NULL')) {
				$this->command->info('Altered table players by adding `verified` column.');
			} else {
				die('Error altering table players.');
			}
		}
		$players = DB::select('SELECT id, ssn FROM players WHERE ssn IS NOT NULL');
		$tmpPlayer = new Player;
		$invalidCnt = 0;
		foreach ($players as $player) {
			if (!$tmpPlayer->checkSSN($player->ssn)) {
				$affected = DB::affectingStatement('UPDATE players SET ssn=null WHERE id='.$player->id);
				if ($affected) $invalidCnt++;
			}
		}
		if ($invalidCnt) $this->command->info($invalidCnt.' SSNs were set to null.');
		
		$affected = DB::affectingStatement('UPDATE players SET verified=0 WHERE ssn IS NULL OR birthDate IS NULL OR name IS NULL OR surname IS NULL');
		if ($affected) $this->command->info($affected.' players with null ssn/birthdate/name/surname were set as unverified.');
		/* drop name index if it exists */
//		DB::statement('ALTER TABLE players DROP INDEX `name`');
		
		/* General fixes */
		DB::statement('UPDATE players SET birthYear=NULL WHERE birthYear<1910');
		DB::statement('UPDATE players SET birthDate=NULL WHERE YEAR(birthDate)<1910');
		DB::statement('UPDATE players SET birthYear=YEAR(birthDate) WHERE birthYear IS NULL AND birthDate IS NOT NULL');
		DB::statement('UPDATE players SET mother=\'\' WHERE mother IS NULL OR LENGTH(mother)<2');
		DB::statement('UPDATE players SET father=\'\' WHERE father IS NULL OR LENGTH(father)<2');
		DB::statement('UPDATE players SET birthPlace=\'\' WHERE birthPlace IS NULL OR LENGTH(birthPlace)<2');
		DB::statement('UPDATE players SET address=\'\' WHERE address IS NULL OR LENGTH(address)<5');
		
		// Manual fixing of ssn numbers that belong to other players
		$wrongSSNs = array(
			'416315' => '11324289606',
			'413869' => '42707108436',
			'416898' => '42946103100',
			'413027' => '48283674204',
			'416286' => '58111592822'
		);
		foreach($wrongSSNs as $id => $ssn) {
			if (DB::affectingStatement("UPDATE players SET ssn=NULL, verified=0 WHERE id=$id AND ssn=$ssn")) {
				$this->command->info('Setting SSN to null that is used by verified player: '.$ssn.'-'.$id);
			}
		}
		
		$players = DB::select('SELECT id, ssn, name, surname, YEAR(birthDate) as birthYear FROM players WHERE verified IS NULL');
		if (count($players)) {
			$soap = New SoapClient('https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL', array('soap_version'   => SOAP_1_2));
			$cnt = $verifyCnt = $unverifyCnt = 0;
			$this->command->info('Started processing '.count($players).' players.');
			foreach($players as $player) {
				$cnt++;
				$player->name = mb_convert_encoding($player->name, 'UTF-8', 'ISO-8859-9');
				$player->surname = mb_convert_encoding($player->surname, 'UTF-8', 'ISO-8859-9');
				$TCKimlikNoDogrula = (object) array(
					'TCKimlikNo' => (float) $player->ssn,
					'Ad' => $player->name,
					'Soyad' => $player->surname,
					'DogumYili' => (int) $player->birthYear
				);
				try {
					$response = $soap->TCKimlikNoDogrula($TCKimlikNoDogrula);
				} catch (Exception $e) {
					die('Caught exception (probably soap fault): '.print_r($TCKimlikNoDogrula, true).' - '.$e->getMessage());
				}
				if ($response->TCKimlikNoDogrulaResult) {
					if (DB::affectingStatement('UPDATE players SET verified=1 WHERE id='.$player->id)) {
						$this->command->info(sprintf('%04d', $cnt).'. Verified: '.$player->id.'-'.$player->ssn.' '.$player->name.' '.$player->surname.' '.$player->birthYear);
						$verifyCnt++;
					}
				} else {
					if (DB::affectingStatement('UPDATE players SET verified=0 WHERE id='.$player->id)) {
						$this->command->info(sprintf('%04d', $cnt).'. Unvrfied: '.$player->id.'-'.$player->ssn.' '.$player->name.' '.$player->surname.' '.$player->birthYear);
						$unverifyCnt++;
					}
				}
//				usleep(40000);
			}
			$this->command->info('Finished processing '.count($players).' players. '.$verifyCnt.' verified, '.$unverifyCnt.' unverified.');
		}
		$dups0 = DB::select('SELECT ssn, count(*) as cnt FROM players WHERE ssn IS NOT NULL GROUP BY ssn HAVING cnt>1 ORDER BY cnt desc, ssn');
		$dups = array();
		foreach($dups0 as $dup0) {
			if ($dup0->cnt > 2) die('3+ players with same valid ssn were found. Please fix manually. SSN: '.$dup0->ssn);
			$dups[] = $dup0->ssn;
		}
		$msgs = array(
			0 => array(),
			1 => array(),
			2 => array(),
			3 => array()
		);
		foreach($dups as $dup) {
			$players = DB::select("
				SELECT p.*, sum(m.MP) as summp
				FROM players p LEFT JOIN
					masterpoint m ON (p.id=m.playerId)
				WHERE p.ssn=$dup
				GROUP BY p.id
				ORDER BY verified, id"
			);
			$p1 = $players[0];
			$p2 = $players[1];
			$attrs = array('name', 'surname', 'father', 'mother', 'city', 'birthDate', 'birthPlace', 'gender', 'email', 'address', 'phone', 'mobile', 'nameInUse');
			$simsum = 0.0;
			$simcnt = 0;
			foreach($attrs as $attr) {
				if (empty($p1->$attr) || empty($p2->$attr) || !$p1->$attr || !$p2->$attr || $p1->$attr == '.' || $p2->$attr == '.' ||
					($attr == 'birthDate' && ($p1->$attr == '0000-00-00' || $p2->$attr == '0000-00-00'))) continue;
				$p1->$attr = trim(mb_convert_encoding( (string) $p1->$attr, 'UTF-8', 'ISO-8859-9'));
				$p2->$attr = trim(mb_convert_encoding( (string) $p2->$attr, 'UTF-8', 'ISO-8859-9'));
				similar_text($p1->$attr, $p2->$attr, $prob);
				$simsum += $prob;
				similar_text($p2->$attr, $p1->$attr, $prob);
				$simsum += $prob;
				$simcnt += 2;
				if ($attr == 'phone' || $attr == 'workPhone' || $attr == 'mobile' || $attr == 'email' || $attr == 'birthDate') {
					if (strlen($p1->$attr)>6 && $p1->$attr == $p2->$attr) $simsum += 150;
				}
			}
			$simsum = $simsum/$simcnt;
			$similarity_threshold = 66;
			if ($simsum >= $similarity_threshold) {
				$oldPlayerId = $p1->id; $oldLicenceNo = $p1->licenceNo; $oldApproveYears = $p1->approveYears;
				$newPlayerId = $p2->id; $newLicenceNo = $p2->licenceNo;
				$query = "UPDATE tbfPairs SET player1Id='$newPlayerId' WHERE player1Id='$oldPlayerId'";
				if (!DB::statement($query)) die("'$query'de hata oluştu. Eski: $oldLicenceNo-$oldPlayerId, Yeni: $newLicenceNo-$newPlayerId");
				$query = "UPDATE tbfPairs SET player2Id='$newPlayerId' WHERE player2Id='$oldPlayerId'";
				if (!DB::statement($query)) die("'$query'de hata oluştu. Eski: $oldLicenceNo-$oldPlayerId, Yeni: $newLicenceNo-$newPlayerId");
				$query = "UPDATE tbfTeamPlayers SET playerId='$newPlayerId' WHERE playerId='$oldPlayerId'";
				if (!DB::statement($query)) die("'$query'de hata oluştu. Eski: $oldLicenceNo-$oldPlayerId, Yeni: $newLicenceNo-$newPlayerId");
				$query = "UPDATE regionalPairs SET player1Id='$newPlayerId' WHERE player1Id='$oldPlayerId'";
				if (!DB::statement($query)) die("'$query'de hata oluştu. Eski: $oldLicenceNo-$oldPlayerId, Yeni: $newLicenceNo-$newPlayerId");
				$query = "UPDATE regionalPairs SET player2Id='$newPlayerId' WHERE player2Id='$oldPlayerId'";
				if (!DB::statement($query)) die("'$query'de hata oluştu. Eski: $oldLicenceNo-$oldPlayerId, Yeni: $newLicenceNo-$newPlayerId");
				$query = "UPDATE regionalTeamPlayers SET playerId='$newPlayerId' WHERE playerId='$oldPlayerId'";
				if (!DB::statement($query)) die("'$query'de hata oluştu. Eski: $oldLicenceNo-$oldPlayerId, Yeni: $newLicenceNo-$newPlayerId");
				$query = "UPDATE masterpoint SET playerId='$newPlayerId' WHERE playerId='$oldPlayerId'";
				if (!DB::statement($query)) die("'$query'de hata oluştu. Eski: $oldLicenceNo-$oldPlayerId, Yeni: $newLicenceNo-$newPlayerId");
				$query = "UPDATE players SET approveYears=(approveYears | $oldApproveYears) WHERE id='$newPlayerId'";
				if (!DB::statement($query)) die("'$query'de hata oluştu. Eski: $oldLicenceNo-$oldPlayerId-$oldApproveYears, Yeni: $newLicenceNo-$newPlayerId");
				$query = "DELETE FROM players WHERE id='$oldPlayerId'";
				if (!DB::statement($query)) die("'$query'de hata oluştu. Eski: $oldLicenceNo-$oldPlayerId, Yeni: $newLicenceNo-$newPlayerId");
				$msgs[0][] = 'Auto Joined: '.$p1->ssn.' '.sprintf('%06s => %06s', $p1->licenceNo, $p2->licenceNo).' similarity is '.sprintf('%.1f', $simsum).'%';
			} elseif ($p2->verified) {
				$msgs[2][] = 'Manually Fix: '.$p1->ssn.' '.sprintf('%06s => %06s', $p1->licenceNo, $p2->licenceNo).' similarity is '.sprintf('%.1f', $simsum).'%';
			} else {
				$msgs[3][] = 'Manually Fix: '.$p1->ssn.' '.sprintf('%06s <> %06s', $p1->licenceNo, $p2->licenceNo).' similarity is '.sprintf('%.1f', $simsum).'%';
			}
		}
		foreach ($msgs as $msgArr) {
			foreach ($msgArr as $msg) {
				$this->command->info($msg);
			}
		}
		DB::setDefaultConnection('mysql');
	}

}

<?php

use Odeva\Masterpoint\Model\Player;

class TbricfedDbFixer extends Seeder {

/*
SSN: 10094555188 343024 => 340193 similarity is 82.2%
SSN: 10208029338 180003 => 180005 similarity is 84.4%
SSN: 10279179826 342594 => 160108 similarity is 75.9%
SSN: 11029073340 063790 => 063792 similarity is 75.5%
SSN: 11224072346 341804 => 350398 similarity is 78.0%
SSN: 11324289606 342542 => 280046 similarity is 32.4%
SSN: 11857125976 063794 => 063789 similarity is 62.8%
SSN: 12521284814 310317 => 310319 similarity is 76.7%
SSN: 12662071410 590292 => 590295 similarity is 84.5%
SSN: 12883729404 063865 => 063863 similarity is 81.3%
SSN: 13001768084 354017 => 354046 similarity is 69.5%
SSN: 13142358052 063744 => 063740 similarity is 57.2%
SSN: 15167392172 343033 => 343032 similarity is 77.2%
SSN: 15364012248 063889 => 063890 similarity is 83.0%
SSN: 16948957436 310315 => 063918 similarity is 68.9%
SSN: 17002401162 050018 => 050020 similarity is 68.5%
SSN: 17552354192 353862 => 350832 similarity is 55.2%
SSN: 17591277728 342739 => 342735 similarity is 51.3%
SSN: 18592348448 050016 => 050022 similarity is 52.9%
SSN: 18800102954 330225 => 330093 similarity is 63.9%
SSN: 21391972868 240012 => 550159 similarity is 60.1%
SSN: 23132621202 343028 => 342852 similarity is 68.1%
SSN: 23791576202 180004 => 180007 similarity is 81.5%
SSN: 25279141674 050017 => 050021 similarity is 68.6%
SSN: 25699016132 440118 => 342936 similarity is 71.7%
SSN: 25850506168 390134 => 600005 similarity is 76.9%
SSN: 27004024986 063861 => 030099 similarity is 75.9%
SSN: 27763797862 140037 => 140030 similarity is 61.3%
SSN: 27955389806 342967 => 342943 similarity is 69.1%
SSN: 28726026722 050015 => 050019 similarity is 68.3%
SSN: 28774674678 330228 => 330050 similarity is 45.2%
SSN: 29161506268 210129 => 210128 similarity is 73.7%
SSN: 29407388900 342920 => 342948 similarity is 81.6%
SSN: 30616916822 350928 => 351006 similarity is 55.1%
SSN: 32518041206 100173 => 350393 similarity is 66.4%
SSN: 32875004920 090296 => 353859 similarity is 65.4%
SSN: 33071228646 550162 => 550143 similarity is 66.7%
SSN: 33448814588 341818 => 341601 similarity is 60.5%
SSN: 34705729232 353919 => 353924 similarity is 39.7%
SSN: 36694742124 353948 => 350665 similarity is 66.1%
SSN: 37153060544 063912 => 063917 similarity is 78.2%
SSN: 37843107788 180002 => 180006 similarity is 91.8%
SSN: 37864677086 353984 => 353888 similarity is 83.0%
SSN: 39088806518 260172 => 430032 similarity is 67.6%
SSN: 39403337260 063925 => 063919 similarity is 87.6%
SSN: 41053333776 200113 => 310038 similarity is 64.4%
SSN: 42707108436 480459 => 353588 similarity is 35.2%
SSN: 42946103100 210102 => 100202 similarity is 34.5%
SSN: 48283674204 062404 => 062405 similarity is 46.8%
SSN: 49177589864 480543 => 470041 similarity is 37.4%
SSN: 52336171008 343041 => 540150 similarity is 72.9%
SSN: 53374616230 410047 => 610043 similarity is 39.6%
SSN: 54541204588 170100 => 170070 similarity is 73.7%
SSN: 58111592822 800032 => 063457 similarity is 25.9%
SSN: 58990015658 370080 => 370081 similarity is 78.9%
SSN: 59167333872 063867 => 063780 similarity is 80.5%
SSN: 63325167216 520099 => 520097 similarity is 61.5%
SSN: 66352309284 342954 => 342853 similarity is 78.2%
SSN: 71509004578 670213 => 060252 similarity is 78.6%
 */
	public function run()
	{
		DB::setDefaultConnection('tbricfed');
		$dups0 = DB::select('SELECT ssn, count(*) as cnt FROM players WHERE ssn IS NOT NULL GROUP BY ssn HAVING cnt>1 ORDER BY cnt desc, ssn');
		$p = new Player;
		$dups = array();
		foreach($dups0 as $dup0) {
			if (!$p->checkSSN($dup0->ssn)) {
				$this->command->info('skipping invalid ssn: '.$dup0->ssn);
				continue;
			}
			if ($dup0->cnt > 2) die('3+ players with same valid ssn were found. Please fix manually. SSN: '.$dup0->ssn);
			$dups[] = $dup0->ssn;
		}
		foreach($dups as $dup) {
			$players = DB::select("
				SELECT p.*, sum(m.MP) as mp
				FROM players p LEFT JOIN
					masterpoint m ON (p.id=m.playerId)
				WHERE p.ssn=$dup
				GROUP BY p.id
				ORDER BY mp"
			);
			$p1 = $players[0];
			$p2 = $players[1];
			$attrs = array('name', 'surname', 'father', 'mother', 'city', 'birthDate', 'birthPlace', 'gender', 'email', 'address', 'phone', 'mobile', 'nameInUse');
			$simsum = 0.0;
			foreach($attrs as $attr) {
				$p1->$attr = (string) $p1->$attr; //mb_convert_encoding( (string) $p1->$attr, 'UTF-8', 'ISO-8859-9');
				$p2->$attr = (string) $p2->$attr; //mb_convert_encoding( (string) $p2->$attr, 'UTF-8', 'ISO-8859-9');
				similar_text($p1->$attr, $p2->$attr, $prob);
				$simsum += $prob;
			}
			$simsum = $simsum/count($attrs);
			$this->command->info('SSN: '.$p1->ssn.' '.sprintf('%06s => %06s', $p1->licenceNo, $p2->licenceNo).' similarity is '.sprintf('%.1f', $simsum).'%');
//			$this->command->info('Names: '.$p1->name.' '.$p1->surname.' vs '.$p2->name.' '.$p2->surname.' AND '.$p1->nameInUse.' vs '.$p2->nameInUse);
//			$this->command->info('Parents: '.$p1->father.' vs '.$p2->father.' AND '.$p1->mother.' vs '.$p2->mother);
//			$this->command->info('Birth: '.$p1->birthDate.' vs '.$p2->birthDate.' AND '.$p1->birthPlace.' vs '.$p2->birthPlace);
//			$this->command->info('City/Gender: '.$p1->city.' vs '.$p2->city.' AND '.$p1->gender.' vs '.$p2->gender);
//			$this->command->info('Email/Address: '.$p1->email.' vs '.$p2->email.' AND '.$p1->address.' vs '.$p2->address);
//			$this->command->info('Phones: '.$p1->phone.' vs '.$p2->phone.' AND '.$p1->mobile.' vs '.$p2->mobile);
		}
		DB::setDefaultConnection('mysql');
		die();
	}

}

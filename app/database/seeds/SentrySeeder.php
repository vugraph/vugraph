<?php

class SentrySeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('users')->truncate();
		DB::table('groups')->truncate();
		DB::table('users_groups')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');

		$players = DB::table('players')->select('id', 'first_name', 'last_name', 'email', 'birth_date', 'ssn_verified')->whereNotNull('email')->get();
		$createCount = $mergeCount = $failCount = 0;
		foreach ($players as $player) {
			try {
//				$password = (empty($player->birth_date) || !$player->ssn_verified)
//					? Str::randomString(12)
//					: substr($player->birth_date, 8, 2).substr($player->birth_date, 5, 2).substr($player->birth_date, 0, 4);
				$newuser = Sentry::createUser(array(
					'email'				=> $player->email,
					'password'			=> 'PObaGD3CD5cv',
				    'first_name'		=> $player->first_name,
				    'last_name'			=> $player->last_name,
				    'activated'			=> 0,
					'auth_player'		=> $player->id
				));
			} catch (Exception $e) {
				die($e->getMessage());
			}
			$createCount++;
		}
		$this->command->info($createCount.' users were created using player data.');

		$users = DB::connection('tbricfed')->select('
			SELECT *
			FROM authorizedUsers
			WHERE disabled=\'N\' AND (
				(
					accessLevel % 2 = 1 AND username IN (
						SELECT authorizedUser
						FROM clubs
						WHERE authorizedUser IS NOT NULL AND authorizedUser NOT LIKE \'\'
						GROUP BY authorizedUser
					)
				) OR (
					(accessLevel >> 1) % 2 = 1 AND username IN (
						SELECT authorizedUser
						FROM regions
						WHERE authorizedUser IS NOT NULL AND authorizedUser NOT LIKE \'\'
						GROUP BY authorizedUser
					)
				) OR (
					(accessLevel >> 3) % 2 = 1
				) OR (
					(accessLevel >> 4) % 2 = 1
				)
			)
		');
		foreach($users as $user) {
			if ($user->disabled == 'Y') continue;
			$user->username = trim(mb_convert_encoding($user->username, 'UTF-8', 'ISO-8859-9'));
			$user->password = mb_convert_encoding($user->password, 'UTF-8', 'ISO-8859-9');
			$user->name = Str::strtoupperTr(trim(mb_convert_encoding($user->name, 'UTF-8', 'ISO-8859-9')));
			$orig_email = $user->eMail = trim(mb_convert_encoding($user->eMail, 'UTF-8', 'ISO-8859-9'));
			$user->eMail = strtolower(Str::sanitizeEmail($user->eMail));
			if ($orig_email != $user->eMail) $this->command->info($user->username.': email '.$orig_email.' => '.$user->eMail);
			if (empty($user->eMail)) {
				$failCount++;
				continue;
			}
			$lastSpaceIndex = strrpos($user->name, ' ');
			if (false === $lastSpaceIndex) {
				$first_name = $user->name;
				$last_name = '';
			} else {
				$first_name = trim(substr($user->name, 0, $lastSpaceIndex));
				$last_name = trim(substr($user->name, $lastSpaceIndex+1));
			}
			$auth_club = $auth_city = $auth_region = null;
			$auth_licence = $auth_admin = false;
			if ($user->accessLevel % 2) {
				$tclub = DB::connection('tbricfed')->select('SELECT id FROM clubs WHERE authorizedUser=\''.$user->username.'\'');
				if (count($tclub) > 1) die('A user can\'t be authorized to two clubs. Username:'.$user->username);
				elseif (count($tclub) == 1) {
					$oldid = $tclub[0]->id;
					$club = DB::table('clubs')->where('old_id', '=', $tclub[0]->id)->first(array('id'));
					$auth_club = $club->id;
				} //else $this->command->info('Info: '.$user->username.' club user does not have access to any club.');
			}
			if (($user->accessLevel >> 1) % 2) {
				$tregion = DB::connection('tbricfed')->select('SELECT id FROM regions WHERE authorizedUser=\''.$user->username.'\'');
				if (count($tregion) > 1) die('A user can\'t be authorized to two regions. Username:'.$user->username);
				elseif (count($tregion) == 1) $auth_city = $tregion[0]->id;
//				else $this->command->info('Info: '.$user->username.' regional user does not have access to any region.');
			}
//			if (($accessLevel >> 2) % 2) { $newuser->auth_admin = true; $newuser->save(); } //$newuser->addGroup($groupUlusal);
			if (($user->accessLevel >> 3) % 2) $auth_licence = true;
			if (($user->accessLevel >> 4) % 2) $auth_admin = true;
			try {
				$newuser = Sentry::findUserByLogin($user->eMail);
				try {
					if ($auth_club) {
						if ($newuser->auth_club) $this->command->info($user->username.' is already authorized to club '.$newuser->auth_club.'. Can\'t authorize him to '.$auth_club);
						else $newuser->auth_club = $auth_club;
						$newuser->old_club_username .= ",'$user->username'";
					}
					if ($auth_city) {
						if ($newuser->auth_city) $this->command->info($user->username.' is already authorized to city '.$newuser->auth_city.'. Can\'t authorize him to '.$auth_city);
						else $newuser->auth_city = $auth_city;
						$newuser->old_city_username .= ",'$user->username'";
					}
					$newuser->auth_licence = $newuser->auth_licence || $auth_licence;
					$newuser->auth_admin = $newuser->auth_admin || $auth_admin;
					$newuser->save();
				} catch (Exception $e) {
					die($e->getMessage());
				}
				$mergeCount++;
			} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
				try {
					$newuser = Sentry::createUser(array(
						'email'				=> $user->eMail,
						'password'			=> $user->password,
					    'first_name'		=> $first_name,
					    'last_name'			=> $last_name,
					    'activated'			=> 0,
						'auth_club'			=> $auth_club,
						'auth_city'			=> $auth_city,
						'auth_licence'		=> $auth_licence,
						'auth_admin'		=> $auth_admin,
						'old_club_username'	=> $auth_club ? "'$user->username'" : '',
						'old_city_username'	=> $auth_city ? "'$user->username'" : ''
					));
				} catch (Exception $e) {
					die($e->getMessage());
				}
				$createCount++;
			}
		} // end foreach

		$this->command->info("=== $createCount users created, $mergeCount users merged, $failCount users failed. ===");
		
		try {
			$me = Sentry::findUserByLogin('guray@sunamak.com');
			$me->activated = 1;
			$me->auth_club = 98; // MAJÖR BOĞAZİÇİ BRİÇ SPOR KULÜBÜ
			$me->auth_city = 34;
			$me->auth_region = 1;
			$me->auth_licence = 1;
			$me->auth_admin = 1;
			$me->password = 'guray';
			$me->save();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

}

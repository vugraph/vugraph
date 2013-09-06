<?php

class SentrySeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('users')->truncate();
		DB::table('groups')->truncate();
		DB::table('users_groups')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');
		try {
			$groupAdmin = Sentry::createGroup(array(
				'name'        => 'superuser',
				'permissions' => array('superuser' => 1)
			));
			$groupVize = Sentry::createGroup(array(
				'name'        => 'visa',
				'permissions' => array('visa' => 1)
			));
			$groupUlusal = Sentry::createGroup(array(
				'name'        => 'national',
				'permissions' => array('national' => 1)
			));
			$groupBolgesel = Sentry::createGroup(array(
				'name'        => 'Bölge Yetkilisi',
				'permissions' => array('regional' => 1)
			));
			$groupKulup = Sentry::createGroup(array(
				'name'        => 'club',
				'permissions' => array('temsilci.kulup' => 1)
			));
			Sentry::createGroup(array(
				'name'        => 'online',
				'permissions' => array('online' => 1)
			));
		} catch (Exception $e) {
			die($e->getMessage());
		}

		$users = DB::connection('tbricfed')->select('SELECT * FROM authorizedUsers ORDER BY disabled DESC, CHAR_LENGTH(eMail) DESC');
		$createCount = $mergeCount = $modifyCount = $failCount = 0;
		foreach($users as $user) {
//			if ($user->disabled !== 'N') continue;
			$newuser = null;
			$user->username = trim(mb_convert_encoding($user->username, 'UTF-8', 'ISO-8859-9'));
			$user->password = trim(mb_convert_encoding($user->password, 'UTF-8', 'ISO-8859-9'));
			$user->name = Str::ucfirst_tr(trim(mb_convert_encoding($user->name, 'UTF-8', 'ISO-8859-9')));
			$user->eMail = trim(mb_convert_encoding($user->eMail, 'UTF-8', 'ISO-8859-9'));
			if (!filter_var($user->eMail, FILTER_VALIDATE_EMAIL)) {
				$sanitized_email = filter_var($user->eMail, FILTER_SANITIZE_EMAIL);
				if (!filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)) $sanitized_email = $user->username.'@tbricfed.org.tr';
				$this->command->info("Email '{$user->eMail}' was changed to '$sanitized_email'.");
				$user->eMail = $sanitized_email;
				$user->disabled = 'Y';
				$modifyCount++;
			}
			$accessLevel = intval($user->accessLevel, 10);
			$validation = Validator::make(
				array('email' => $user->eMail, 'name' => $user->name),
				array('email' => 'required|email|unique:users,email', 'name' => 'required|min:3')
			);
			if ($validation->passes()) {
				$name = trim($user->name);
				$lastSpaceIndex = strrpos($name, ' ');
				if (false === $lastSpaceIndex) {
					$first_name = $name;
					$last_name = '';
				} else {
					$first_name = trim(substr($name, 0, $lastSpaceIndex));
					$last_name = trim(substr($name, $lastSpaceIndex+1));
				}
				try {
					$newuser = Sentry::createUser(array(
						'email'      => $user->eMail,
						'password'   => $user->password,
					    'first_name' => $first_name,
					    'last_name'  => $last_name,
					    'activated'  => $user->disabled == 'N' ? 1 : 0,
						'old_username' => "'$user->username'"
					));
				} catch (Exception $e) {
					die($e->getMessage());
				}
				$createCount++;
			} else {
				$failed = $validation->failed();
				if (count($failed) == 1 && isset($failed['email']) && isset($failed['email']['Unique'])) {
					try {
						$newuser = Sentry::findUserByLogin($user->eMail);
						$newuser->old_username .= ",'$user->username'";
						$newuser->save();
					} catch (Exception $e) {
						die($e->getMessage());
					}
					$mergeCount++;
					if (strtolower($newuser->email) !== strtolower($user->eMail) || trim($newuser->email) == '') die("Should never reach here 1823451329485");
				} else {
					$this->command->info("Skipped invalid user $user->username (email: $user->eMail). Details: {$validation->messages()->first()}");
					$failCount++;
				}
			}
			if (!empty($newuser)) {
				// Assign user permissions
				try {
					if ($accessLevel % 2) $newuser->addGroup($groupKulup);
					if (($accessLevel >> 1) % 2) $newuser->addGroup($groupBolgesel);
					if (($accessLevel >> 2) % 2) $newuser->addGroup($groupUlusal);
					if (($accessLevel >> 3) % 2) $newuser->addGroup($groupVize);
					if (($accessLevel >> 4) % 2) $newuser->addGroup($groupAdmin);
				} catch (Exception $e) {
					die($e->getMessage());
				}
			}
		} // end foreach
		$this->command->info("=== $createCount users created, $mergeCount users merged, $failCount users failed. ===");
		$this->command->info("=== $modifyCount invalid email addresses changed. ===");
	}

}

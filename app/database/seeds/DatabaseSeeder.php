<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->command->info('========== Fixing tbricfed_db ==========');
		$this->call('TbricfedDbFixer');
		$this->command->info('');
		Eloquent::unguard();
		$this->command->info('========== Seeding Regions ==========');
		$this->call('RegionsTableSeeder');
		$this->command->info('');
		$this->command->info('========== Seeding Cities ==========');
		$this->call('CitiesTableSeeder');
		$this->command->info('');
		$this->command->info('========== Seeding Clubs ==========');
		$this->call('ClubsTableSeeder');
		$this->command->info('');
		$this->command->info('========== Seeding Titles ==========');
		$this->call('TitlesTableSeeder');
		$this->command->info('');
		$this->command->info('========== Seeding Players ==========');
		$this->call('PlayersTableSeeder');
		$this->command->info('');
//		$this->command->info('========== Seeding Sentry ==========');
//		$this->call('SentrySeeder');
//		$this->command->info('');
	}
}
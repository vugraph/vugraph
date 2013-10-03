<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
//		$this->command->info('========== Seeding Sentry ==========');
//		$this->call('SentrySeeder');
		$this->command->info('');
		$this->command->info('========== Seeding Regions ==========');
		$this->call('RegionsTableSeeder');
		$this->command->info('');
		$this->command->info('========== Seeding Cities ==========');
		$this->call('CitiesTableSeeder');
		$this->command->info('');
		$this->command->info('========== Seeding Clubs ==========');
		$this->call('ClubsTableSeeder');
		$this->command->info('');
	}
}
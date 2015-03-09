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

		$this->call('UserTableSeeder');
		$this->command->info('User table seeded!');

		$this->call('ProfileTableSeeder');
		$this->command->info('Profile table seeded!');

		$this->call('TeamTableSeeder');
		$this->command->info('Team table seeded!');

		$this->call('VenueTableSeeder');
		$this->command->info('Venue table seeded!');

	}

}

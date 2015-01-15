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

		$this->call('EventTableSeeder');
		$this->command->info('Event table seeded!');

		$this->call('UserTableSeeder');
		$this->command->info('User table seeded!');

		$this->call('TeamTableSeeder');
		$this->command->info('Team table seeded!');

		$this->call('TeamUserTableSeeder');
		$this->command->info('Team User table seeded!');
	}

}

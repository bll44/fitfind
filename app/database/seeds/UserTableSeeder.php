<?php

class UserTableSeeder extends Seeder {

	public function run()
	{
		// allow mass assignment
		Eloquent::unguard();

		// delete all rows in users table
		User::truncate();

		$faker = Faker\Factory::create();
		$genders = [null, 'male', 'female'];

		for($i = 0; $i < 30; $i++)
		{
			User::create([
				'displayname' => $faker->name,
				'username' => $faker->username,
				'email' => $faker->email,
				'password' => '1234',
				'street' => $faker->streetAddress,
				'unit' => $faker->secondaryAddress,
				'city' => $faker->city,
				'state' => $faker->state,
				'zip' => rand(10000, 99999),
				'dob' => $faker->date(),
				'gender' => $genders[array_rand($genders)],
				'phone' => 1234567890,
				'notifyEmail' => $faker->boolean(50),
				'notifyText' => $faker->boolean(50),
				'created_at' => date('Y-m-d h:i:s'),
				'updated_at' => date('Y-m-d h:i:s'),
			]);
		}
	}

}
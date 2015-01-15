<?php

class UserTableSeeder extends Seeder {

	public function run()
	{
		// allow mass assignment
		Eloquent::unguard();

		DB::table('users')->delete();
		$faker = Faker\Factory::create();
		$genders = [null, 'male', 'female'];

		for($i = 0; $i < 70; $i++)
		{
			$gender_index = array_rand($genders);
			User::create([
				'displayname' => $faker->name,
				'username' => $faker->username,
				'email' => $faker->email,
				'password' => '1234',
				'street1' => $faker->streetAddress,
				'street2' => $faker->secondaryAddress,
				'city' => $faker->city,
				'state' => $faker->state,
				'zip' => $faker->postcode,
				'dob' => $faker->date(),
				'gender' => $genders[$gender_index],
				'phone' => 7775559999,
				'notifyEmail' => $faker->boolean(50),
				'notifyText' => $faker->boolean(50),
				'created_at' => date('Y-m-d h:i:s'),
				'updated_at' => date('Y-m-d h:i:s'),
			]);
		}
	}

}
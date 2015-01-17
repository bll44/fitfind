<?php

class ProfileTableSeeder extends Seeder {

	public function run()
	{
		// allow mass assignment
		Eloquent::unguard();

		// delete all rows in users table
		Profile::truncate();

		$faker = Faker\Factory::create();

		for($i = 1; $i <= 30; $i++)
		{
			Profile::create([
				'user_id' => $i,
				'bio' => $faker->text(625),
				'location' => $faker->streetAddress,
				'created_at' => date('Y-m-d h:i:s'),
				'updated_at' => date('Y-m-d h:i:s'),
			]);
		}
	}

}
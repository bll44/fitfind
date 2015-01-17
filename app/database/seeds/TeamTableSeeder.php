<?php

class TeamTableSeeder extends Seeder {

	public function run()
	{
		// allow mass assignment
		Eloquent::unguard();

		// delete all rows in teams table
		Team::truncate();
		$faker = Faker\Factory::create();

		$user_ids = User::all()->lists('id');

		for($i = 1; $i <= 30; $i++)
		{
			Team::create([
				'name' => $faker->name,
				'description' => $faker->text,
				'team_leader_id' => $user_ids[array_rand($user_ids)],
				'created_at' => date('Y-m-d h:i:s'),
				'updated_at' => date('Y-m-d h:i:s'),
			]);
		}
	}

}
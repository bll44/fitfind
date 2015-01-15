<?php

class TeamTableSeeder extends Seeder {

	public function run()
	{
		// allow mass assignment
		Eloquent::unguard();

		DB::table('teams')->delete();
		$faker = Faker\Factory::create();

		$users = User::all();

		$user_ids = [];
		foreach($users as $u)
		{
			$user_ids[] = $u->id;
		}

		for($i = 0; $i < 70; $i++)
		{
			Team::create([
				'name' => $faker->name,
				'description' => $faker->text,
				'max_players' => $faker->numberBetween(0, 20),
				'team_leader_id' => array_rand($user_ids),
				'locked' => rand(0, 1),
				'created_at' => date('Y-m-d h:i:s'),
				'updated_at' => date('Y-m-d h:i:s'),
			]);
		}
	}

}
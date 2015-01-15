<?php

class TeamUserTableSeeder extends Seeder {

	public function run()
	{
		// allow mass assignment
		Eloquent::unguard();

		DB::table('team_user')->delete();
		$faker = Faker\Factory::create();

		$teamid = DB::table('teams')->lists('id');
		$userid = DB::table('users')->lists('id');

		for($i = 0; $i < 70; $i++)
		{
			DB::table('team_user')->insert(array('team_id' => array_rand($teamid), 'user_id' => array_rand($userid)));
		}
	}

}
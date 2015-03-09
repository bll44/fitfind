<?php

class VenueTableSeeder extends Seeder {

	public function run()
	{
		// allow mass assignment
		Eloquent::unguard();

		// delete all rows in users table
		Venue::truncate();

		$faker = Faker\Factory::create();

		$venues = array(
			[
				'name' => 'Dasklaskis Athletic Center',
				'description' => 'The Home of the Drexel Dragons Varsity Athletic Indoor Teams, includes recreational courts, tracks, and gym.',
			],
			[
				'name' => 'Buckley Field',
				'description' => 'Drexel\'s State of the Art artificial turf multi-use outdoor field, includes soccer goal posts and permanent field markings for other sports.',
			],
			[
				'name' => 'Vidas Athletic Complex',
				'description' => 'The practice facility of the Drexel Dragons Varsity Athletic Outdoor Teams, perfect for large recreational competitive games.',
			],
			[
				'name' => 'Buckley Greens',
				'description' => 'Drexel\'s sandy oasis, perfect for late night beach volleyball, with plenty of spectator seating.',
			],
		);

		foreach($venues as $venue)
		{
			Venue::create([
				'name' => $venue['name'],
				'description' => $venue['description'],
				'created_at' => date('Y-m-d h:i:s'),
				'updated_at' => date('Y-m-d h:i:s'),
			]);
		}
	}

}
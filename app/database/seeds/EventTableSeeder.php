<?php

class EventTableSeeder extends Seeder {

	public function run()
	{
		// allow mass assignment
		Eloquent::unguard();

		DB::table('events')->delete();
		$faker = Faker\Factory::create();

		$sports_list = array(
			'running',		 'climbing', 	'cyclying',		'golf',
			'football', 	 'baseball',   	'soccer', 	  	'hockey',
			'poker', 		 'skiing',		'basketball',	'swimming',
			'yoga', 		 'volleyball',  'cricket',		'rugby',
			'skateboarding'
		);

		// this needs to be updated!
	}
	/* end run() method */

}
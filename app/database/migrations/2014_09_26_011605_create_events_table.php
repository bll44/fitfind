<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('displayname');
			$table->string('activity');
			$table->integer('organizer_id');
			$table->integer('max_participants')->nullable();
			$table->boolean('team_event')->default(0);
			$table->integer('primary_team_id')->default(0);
			$table->dateTime('start_time');
			$table->dateTime('end_time');
			$table->integer('venue_id');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('events');
	}

}

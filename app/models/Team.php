<?php

class Team extends Eloquent {

	protected $table = 'teams';

	public function members()
	{
		return $this->belongsToMany('User');
	}

	public function createTeam()
	{
		$team = new Team;

		$team->save();
	}

	public function events()
	{
		return $this->belongsToMany('App\Models\Event');
	}

}
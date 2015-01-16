<?php

class Team extends Eloquent {

	protected $table = 'teams';

	public function members()
	{
		return $this->belongsToMany('User');
	}

	public function events()
	{
		return $this->belongsToMany('App\Models\Event');
	}

	public function leader()
	{
		return $this->hasOne('TeamLeader');
	}

}
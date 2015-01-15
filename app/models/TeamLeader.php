<?php

class TeamLeader extends User {

	protected $table = 'users';

	public function teams()
	{
		return $this->hasMany('Team');
	}
}
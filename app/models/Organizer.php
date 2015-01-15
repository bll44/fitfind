<?php

class Organizer extends User {

	protected $table = 'users';

	public function events()
	{
		return $this->hasMany('App\Models\Event');
	}

}
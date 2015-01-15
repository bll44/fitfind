<?php

class Venue extends Eloquent {

	protected $table = 'venues';

	public function events()
	{
		return $this->hasMany('App\Models\Event');
	}

}
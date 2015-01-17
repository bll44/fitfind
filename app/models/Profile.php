<?php

class Profile extends Eloquent {

	protected $table = 'profiles';

	protected $fillable = ['user_id', 'bio', 'location'];

	public function user()
	{
		return $this->belongsTo('User');
	}

}
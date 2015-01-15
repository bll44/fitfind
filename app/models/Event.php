<?php

namespace App\Models;

use Eloquent;
use DB;
use DateTime;

class Event extends Eloquent {

	protected $table = 'events';

	protected $fillable = ['displayname', 'category', 'organizer', 'max_participants', 'team_event', 'start_time', 'end_time', 'location', 'created_at', 'updated_at'];

	public function users()
	{
		return $this->belongsToMany('User');
	}

	public function teams()
	{
		return $this->belongsToMany('Team');
	}

	public function getTime($value)
	{
		$date = new DateTime($this->attributes[$value]);
		return $date->format('F jS \@ h:ia');
	}

	public function venue()
	{
		return $this->belongsTo('Venue');
	}

	public function organizer()
	{
		return $this->belongsTo('Organizer');
	}

	public function f_startTime()
	{
		return date_format(date_create($this->start_time), 'M jS @ h:ia');
	}

	public function f_endTime()
	{
		return date_format(date_create($this->end_time), 'M jS @ h:ia');
	}

}
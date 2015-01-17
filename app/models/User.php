<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = Hash::make($value);
	}

	public function profile()
	{
		return $this->hasOne('Profile');
	}

	public function events()
	{
		return $this->belongsToMany('App\Models\Event');
	}

	public function friends()
	{
		return $this->hasMany('Friend');
	}

	public function teams()
	{
		return $this->belongsToMany('Team');
	}

	public function getApprovals()
	{
		$teams = $this->teams;

		$requests = array();
		$i = 0;
		foreach($teams as $team)
		{
			// if the authenticated user is not the team leader, skip team and move to the next in the queue
			if($this->id !== $team->team_leader_id) continue;

			$result = DB::select("SELECT * FROM team_approvals
							  	  WHERE team_id='{$team->id}'");

			if(count($result) > 0)
			{
				foreach($result as $row)
				{
					$requests[$i]['approval_id'] = $row->id;
					$requests[$i]['user'] = User::find($row->user_id);
					$requests[$i]['team'] = Team::find($row->team_id);
					$requests[$i]['approve_url'] = URL::route('teams.approval.update', [$row->id, 'approve']);
					$requests[$i]['deny_url'] = URL::route('teams.approval.update', [$row->id, 'deny']);
					$i++;
				}
			}
		}

		return $requests;
	}

}

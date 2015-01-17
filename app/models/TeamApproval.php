<?php

class TeamApproval extends Eloquent {

	protected $table = 'team_approvals';

	public function approve()
	{
		$user = User::find($this->user_id);
		$user->teams()->attach($this->team_id);
		$this->delete();
	}

	public function deny()
	{
		$this->delete();
	}

}
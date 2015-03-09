<?php


class TeamController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();
		$teams = $user->teams;
		$approvals = $user->getApprovals();

		$help_title = 'My Teams';
		$help_content = 'Whether you’re a team captain (denoted by the asterisk next to your team), or the ultimate teamplayer, 
						you’ll see your teams that you are a part of either way here. You can click “Team Overview” to 
						see other team members, events past and future that your team is a part of, and your team’s description.';

		return View::make('teams.my_teams',	
			[
				'teams' => $teams,
			 	'approvals' => $approvals,
			 	'help_title' => $help_title,
			 	'help_content' => $help_content,
			]
		);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$help_title = 'Creating a team';
		$help_content = 'We find that fitness can be more fun with a team! Now that you’ve decided to create one, you can just 
						add your team’s name (be creative!) and a short (not more than 1,000 characters) fun description, then 
						click “Create Team”. You’ll be redirected to the “My Teams” page where you will see your new team!';
		return View::make('teams.create', ['help_title' => $help_title, 'help_content' => $help_content]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$team = new Team;
		$name = Input::get('team_name');
		$description = Input::get('team_description');
		$user = Auth::user();

		$team->name = $name;
		$team->description = $description;
		$team->team_leader_id = $user->id;

		$validation_rules = [
			'team_name' => 'required',
			'team_description' => 'required',
		];

		$validator = Validator::make(
			Input::all(),
			$validation_rules
		);

		if($validator->passes())
		{
			$team->save();
		}
		elseif($validator->fails())
		{
			return Redirect::route('teams.create')->withInput()->withErrors($validator);
		}

		$user->teams()->attach($team->id);

		return Redirect::route('teams.index');
	}

	public function join()
	{
		$team_id = Input::get('team');
		$team = Team::find($team_id);
		$candidate = Auth::user();
		$teamLeader = TeamLeader::find($team->team_leader_id);

		// create team join request record in database for approval
		DB::insert("INSERT INTO team_approvals (team_id, user_id, created_at, updated_at)
					VALUES (?, ?, NOW(), NOW())", [$team->id, $candidate->id]);

		// send an email notification to the team leader that there is a new candidate available for the team
		Mail::send('emails.teams.join_request', ['candidate' => $candidate, 'team' => $team, 'teamLeader' => $teamLeader],
			function($message) use ($candidate, $teamLeader)
			{
				$message->to($teamLeader->email, $teamLeader->displayname)->subject($candidate->displayname . ' wants to join your team.');
			}
		);

		return json_encode(['status_code' => 200]);
	}

	public function cancelJoin()
	{
		$team_id = Input::get('team');
		$team = Team::find($team_id);
		$candidate = Auth::user();

		$teamApproval = TeamApproval::where('team_id', $team->id)->where('user_id', $candidate->id)->first();
		$teamApproval->delete();

		return json_encode(['status_code' => 200]);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$team = Team::with('Members', 'Events')->whereId($id)->first();
		return View::make('teams.show', ['team' => $team]);
	}

	public function browse()
	{
		$teams = Team::orderBy('created_at', 'DESC')->where('team_leader_id', '<>', Auth::user()->id)->get();
		$my_teams = array();
		foreach(Auth::user()->teams as $team)
		{
			$my_teams[] = $team->id;
		}
		$team_approvals = TeamApproval::where('user_id', Auth::user()->id)->get();
		$requested = array();
		foreach($team_approvals as $ta)
		{
			$requested[] = $ta->team_id;
		}

		$help_title = 'Want to join a team?';
		$help_content = 'You’ve come to the right place! Scroll on through the list of teams, and hit 
						“Request to Join This Team” to send a request to the Team Captain. Reconsidering? 
						Just click on the "Request Sent” button to take back this request!';

		return View::make('teams.browse', ['teams' => $teams, 'my_teams' => $my_teams, 'requested' => $requested,
											'help_title' => $help_title, 'help_content' => $help_content]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function getApprovalRequests()
	{
		$user = Auth::user();
		$approvals = $user->getApprovals();

		if(count($approvals) > 0)
			$data = ['hasApprovals' => true, 'approvals' => $approvals];
		else
			$data = ['hasApprovals' => false];

		return json_encode($data);
	}

	public function updateApprovalRequest($id, $status)
	{
		if($status === 'approve')
		{
			TeamApproval::find($id)->approve();
		}
		elseif($status === 'deny')
		{
			TeamApproval::find($id)->deny();
		}

		return Redirect::route('teams.index');
	}

}

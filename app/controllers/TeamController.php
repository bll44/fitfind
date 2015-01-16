<?php


class TeamController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$teams = Auth::user()->teams;

		$team_ids = array();
		foreach($teams as $team)
		{
			if($team->team_leader_id === Auth::user()->id)
			{
				$team_ids[] = $team->id;
			}
		}

		return View::make('teams.my_teams',
			compact('teams')
		);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('teams.create');
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

		$team->save();

		$user->teams()->attach($team->id);

		return Redirect::route('teams.index');
	}

	public function join($team_id)
	{
		$team = Team::find($team_id);
		$candidate = Auth::user();
		$teamLeader = TeamLeader::find($team->team_leader_id);

		// create team join request record in database for approval
		DB::insert("INSERT INTO team_join_requests (team_id, user_id, created_at, updated_at)
					VALUES (?, ?, NOW(), NOW())", [$team->id, $candidate->id]);

		// send an email notification to the team leader that there is a new candidate available for the team
		Mail::send('emails.team_join_request',
				  ['candidate' => $candidate, 'team' => $team, 'teamLeader' => $teamLeader],
				  function($message) use ($candidate, $teamLeader)
				  {
			  	  	 $message->to($teamLeader->email, $teamLeader->displayname)->subject($candidate->displayname . ' wants to join your team.');
				  });

		return Redirect::route('teams.index');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	public function browse()
	{
		$teams = Team::all();

		return View::make('teams.browse', ['teams' => $teams]);
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

}

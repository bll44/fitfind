<?php


class TeamController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$joined_teams = Auth::user()->teams;

		$team_leader = TeamLeader::find(Auth::user()->id);

		$created_teams = $team_leader->teams;

		return View::make('teams.my_teams', ['joined_teams' => $joined_teams, 'created_teams' => $created_teams, 'team_leader' => $team_leader]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('teams.create_teams');

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$team = new Team;
		$name = Input::get('teamName');
		$description = Input::get('teamDescription');
		$lock_team = Input::get('lockTeam');
		$team_leader = Auth::user()->id;

		$team->name = $name;
		$team->description = $description;
		if($lock_team == 'yes')
		{
			$team->locked = 1;
		}
		else
		{
			$team->locked = 0;
		}
		$team->team_leader_id = $team_leader;

		// DB::table('team_user')->insert(
		//     array('team_id' => $team->id, 'user_id' => Auth::user()->id)
		// );

		$team->save();


		return Redirect::route('teams.index');
	}

	public function join($team_id)
	{
		$team = Team::find($team_id);
		$user = Auth::user();
		$teamLeader = TeamLeader::find($team->team_leader_id);

		Mail::send('emails.team_join_request',
				  ['user' => $user, 'team' => $team, 'teamLeader' => $teamLeader],
				  function($message) use ($user, $teamLeader)
				  {
			  	  	 $message->to($teamLeader->email, $teamLeader->displayname)->subject($user->displayname . ' wants to join your team.');
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

	public function listTeams()
	{
		$teams = Team::all();

		return View::make('teams.list_teams', ['teams' => $teams]);
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

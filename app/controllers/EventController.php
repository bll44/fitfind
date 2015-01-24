<?php

// namespace App\Controllers;

use App\Models\Event;
// use View;
// use Input;

class EventController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$events = Event::orderBy('start_time', 'ASC')->get();

		return View::make('events.index', ['events' => $events]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// List of Activities, will be pulled from the database in the future
		$activities = Config::get('activities');

		$teams = Team::where('team_leader_id', Auth::user()->id)->get();
		$venues = Venue::all();
		return View::make('events/create', ['activePage' => 'events', 'activities' => $activities,
											'teams' => $teams, 'venues' => $venues]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// return Input::all();
		$validator = Validator::make(
			Input::all(),
			[
				'organizer' => 'required|integer',
				'venue' => 'required|integer',
				'start_time' => 'required|date_format:Y-m-d H:i',
				'end_time' => 'required|date_format:Y-m-d H:i'
			]
		);

		if($validator->fails())
		{
			return Redirect::back();
		}

		$event = new Event;
		$event->activity = Input::get('activity');
		$event->displayname = $event->activity;
		$event->max_participants = Input::get('max_participants');
		$event->start_time = Input::get('start_time');
		$event->end_time = Input::get('end_time');
		$event->venue_id = Input::get('venue');

		if(Input::has('team_event'))
		{
			$team_id = Input::get('team');
			$event->team_event = 1;
			$event->organizer_id = $team_id;
			$team = Team::find($team_id);
		}
		else
		{
			$event->team_event = 0;
			$event->organizer_id = Auth::user()->id;
		}

		if($event->save())
		{
			if($event->team_event)
				$event->teams()->attach($team->id);
			else
				$event->users()->attach(Auth::user()->id);

			return View::make('events/created', ['event' => $event]);
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$event = Event::find($id);

		if($event->team_event && null !== Auth::user()->teams)
		{
			return Redirect::back()->with('no_teams_error', 'You must be on a team to see this event.');
		}

		$teams = array();
		foreach(TeamLeader::find(Auth::user()->id)->teams as $team)
		{
			$teams[] = $team;
		}
		foreach(Auth::user()->teams as $team)
		{
			$teams[] = $team;
		}

		return View::make('events.show', ['event' => $event, 'teams' => $teams]);
	}

	public function joinEvent($id)
	{
		if(Input::has('team_id'))
		{
			$team = Team::find(Input::get('team_id'));
			$team->events()->attach($id);
		}
		else
		{
			Auth::user()->events()->attach($id);
		}
		return Redirect::route('user.events.show', [Auth::user()->id]);
	}

	public function showUserEvents($id)
	{
		$user = User::find($id);
		$user_events = $user->events;
		$user_teams = $user->teams;

		$team_events = array();
		foreach($user_teams as $team)
		{
			$team->{'events'} = $team->events;
			$team->team_name = $team->name;
			$team_events[] = $team;
		}

		return View::make('events.user_events',
				['user' => $user,
				 'team_events' => $team_events,
				 'user_events' => $user_events]
		);
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

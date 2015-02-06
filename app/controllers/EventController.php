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
		$events = Event::where('organizer_id', '<>', Auth::user()->id)->orderBy('start_time', 'ASC')->get();

		return View::make('events.index', ['events' => $events, 'activePage' => 'events']);
	}


	/**
	 * Show the form for creating a new event resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$teams = Team::where('team_leader_id', Auth::user()->id)->get();
		$venues = Venue::all();
		$venueRows = htmlRows($venues, 3);
		$teamRows = htmlRows($teams, 3);

		return View::make('events.create',
			['activePage' => 'events',
			 'teams', $teams,
			 'venues' => $venues,
			 'venueRows' => $venueRows,
			 'teamRows' => $teamRows]
		);
	}


	/**
	 * Store a newly created event in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$event = new Event;
		$event->activity = Input::get('event-type');
		$event->displayname = Input::get('event-name');

		if(Input::has('event-teams-only'))
		{
			$event->team_event = 1;
			$team = Team::find(Input::get('event-team'));
		}

		$event->start_time = Input::get('event-start-time');
		$event->end_time = Input::get('event-end-time');
		$event->max_participants = Input::get('event-max-participants');
		$event->venue_id = Input::get('event-venue');
		$event->organizer_id = Auth::user()->id;

		if($event->save())
		{
			if($event->team_event && $team)
			{
				$event->primary_team_id = $team->id;
				$event->teams()->attach($team->id);
			}
			else
			{
				$event->users()->attach(Auth::user()->id);
			}
			
			return View::make('events.created', ['event' => $event]);
		}
		else
		{
			return Redirect::route('events.create')->withInput();
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

		if($event->team_event && null === Auth::user()->teams)
		{
			return Redirect::back()->with('no_teams_error', 'You must be on a team to see this event.');
		}

		$teams = array();
		foreach(Team::where('team_leader_id', Auth::user()->id)->get() as $team)
		{
			$teams[] = $team;
		}

		$teamRows = htmlRows($teams);

		return View::make('events.show', 
			['event' => $event, 
			 'teams' => $teams, 
			 'teamRows' => $teamRows,
			 'activePage' => 'events']);
	}

	public function joinEvent($id)
	{
		$event = Event::find($id);

		if(Input::has('team-id'))
		{
			$team = Team::find(Input::get('team-id'));
			$team->events()->attach($id);
		}
		elseif(Request::isMethod('get') && $event->team_event)
		{
			return Redirect::to("event/{$event->id}?choose_team=1");
		}
		else
		{
			Auth::user()->events()->attach($id);
		}

		if($event->team_event)
			return Redirect::route('teams.show', [Input::get('team-id')]);
		else
			return Redirect::route('user.events.show', [Auth::user()->id]);
	}

	public function joinTeamEvent($id)
	{
		$event = Event::find($id);
		$teams = Auth::user()->teams;

		return View::make('events.join_team_event', ['event' => $event, 'teams' => $teams]);
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

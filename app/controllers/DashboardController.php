<?php

class DashboardController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$help_title = 'Welcome to the FitFind Dashboard';
		$help_content = 'From here, you can view your Events and Teams that you are a part of by clicking on 
						<b>View my Events</b> and <b>View My Teams</b> respectively.<br><br>If you’re not part of any events or teams, 
						we can help! Just navigate to the omnipresent toolbar at the top of the screen, and click on the 
						<b>Events</b> or <b>Teams</b> dropdowns to browse or create events and teams to join!';

		return View::make('dashboard.index', ['help_title' => $help_title, 'help_content' => $help_content]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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

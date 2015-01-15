<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
	 * List all of a user's friends
	 *
	 * @return Array $friends
	 */
	public function showFriends($username)
	{
		$user = User::where('username', $username)->first();
		$friend_ids = $user->friends;
		$friends = [];
		foreach($friend_ids as $f)
		{
			$friends[] = User::find($f->friend_id);
		}
		return View::make('users.friends.show', ['friends' => $friends]);
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

	public function search()
	{
		$term = Input::get('term');
		$users = DB::table('users')->where('displayname', 'LIKE', '%' . $term . '%')->get();

		$elements = [];
		foreach($users as $user)
		{
			$element = '<li class="list-group-item" data-user_id="'.$user->id.'">';
			$element .= $user->displayname;
			$element .= '<i class="fa fa-plus pull-right add-friend-plus"></i>';
			$element .= '</li>';
			$elements[]['element'] = $element;
		}
		return $elements;
	}


}

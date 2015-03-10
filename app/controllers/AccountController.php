<?php

class AccountController extends \BaseController {

	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

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
		$user = User::find($id);

		$help_title = 'My Account';
		$help_content = 'Your one stop shop for all account related changes. Update any information you’d like to provide 
						FitFind, and click on the “Save Contact Information” or “Save Address Information” button to update 
						your account information.';

		return View::make('accounts.index', ['user' => $user, 'help_title' => $help_title, 'help_content' => $help_content]);
	}

	public function changePassword()
	{
		// set the currently authneticated user
		$this->user = User::find(Auth::user()->id);

		// create the validation for the change password form
		$validator = Validator::make(
			Input::all(),
			array(
				'old_password' => 'required|min:8',
				'new_password' => 'required|confirmed|min:8'
			)
		);

		// verify the old password matches the user's password BEFORE the password change is executed
		if( ! Hash::check(Input::get('old_password'), $this->user->password))
			return json_encode(['status' => 'fail', 'message' => 'Password hash check failed.']);

		$oldPassword = Input::get('old_password');
		$newPassword = Input::get('new_password');
		$confirmedPassword = Input::get('new_password_confirmation');

		// check if the form input passed validation
		if($validator->passes())
		{
			// change the user's password if input passed validation
			$this->user->password = $newPassword;
			if($this->user->save())
				return json_encode(['status' => 'success', 'message' => 'User\'s password successfully updated.']);
		}
		else
		{
			return json_encode(['status' => 'fail', 'message' => 'User\'s password could not be updated for an unknown reason.']);
		}
	}

	public function saveContactInfo()
	{
		$email = Input::get('email');
		$phone = preg_replace('/[^0-9]/', '', Input::get('phone'));
		$name = Input::get('name');

		$validator = Validator::make(
			Input::all(),
			[
				'email' => 'required|email',
				'phone' => 'required|digits:10',
				'name' => 'required'
			]
		);

		if($validator->passes())
		{
			$this->user = User::find(Auth::user()->id);
			if($this->user->email !== $email)
			{
				if(User::where('email', $email)->count())
					return json_encode(['status' => 'fail', 'message' => 'Email address is not available.']);
				else
					$this->user->email = $email;
			}
			$this->user->phone = $phone;
			$this->user->displayname = $name;
			if($this->user->save())
			{
				return json_encode(['status' => 'success', 'message' => 'Contact information updated.']);
			}
		}
		elseif($validator->fails())
		{
			return json_encode(['status' => 'fail', 'message' => $validator->messages()]);
		}
	}

	public function saveAddress()
	{
		$street = Input::get('street');
		$unit = Input::get('unit');
		$city = Input::get('city');
		$state = Input::get('state');
		$zip = Input::get('zip');

		$this->user = User::find(Auth::user()->id);

		$this->user->street = $street;
		$this->user->unit = $unit;
		$this->user->city = $city;
		$this->user->state = $state;
		$this->user->zip = $zip;

		if($this->user->save())
		{
			return json_encode(['status' => 'success', 'message' => 'Address information updated.']);
		}
		else
		{
			return json_encode(['status' => 'fail', 'message' => 'Address information could not be updated.']);
		}
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
		$user = User::find($id);

		$user->delete();

		return Redirect::to('login');
	}


}

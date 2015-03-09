<?php

class AuthController extends \BaseController {

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
	 * Authenticate the user.
	 *
 	 * @return Redirect to intended page.
	 */
	public function loginUser($newUser = false)
	{
		if($newUser)
		{
			if(Auth::attempt(['email' => $this->user->email, 'password' => Input::get('password')]))
			{
				return Redirect::to('dashboard');
			}
		}

		if(Auth::attempt(['username' => Input::get('username_email'), 'password' => Input::get('password')])
			|| Auth::attempt(['email' => Input::get('username_email'), 'password' => Input::get('password')]))
		{
			return Redirect::intended('dashboard');
		}
		else
		{
			return Redirect::to('login')->with('login_failed', true);
		}
	}

	public function logoutUser()
	{
		Auth::logout();
		return Redirect::to('login');
	}

	public function showRegistration()
	{
		return View::make('no_auth.registration');
	}


	/**
	 * Store a newly created account in the database.
	 *
	 * @return Redirect to home page.
	 */
	public function store()
	{
		$validator = Validator::make(
			Input::all(),
			['password' => 'required|confirmed|min:8',
			'displayname' => 'required',
			'username' => 'required|unique:users,username',
			'email' => 'required|email|unique:users,email']
		);

		if($validator->passes())
		{
			$this->user->displayname = Input::get('displayname');
			$this->user->username = Input::get('username');
			$this->user->email = Input::get('email');
			$this->user->password = Input::get('password');

			if($this->user->save())
			{
				$profile = new Profile;
				$profile->user_id = $this->user->id;
				if($profile->save()) return $this->loginUser(true);
			}
		}
		elseif($validator->fails())
		{
			return Redirect::to('register')->withInput()->with('validation_errors', $validator->messages()->all());
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
		//
	}

	public function showForgotPassword()
	{
		return View::make('no_auth.fp_show');
	}

	public function sendTempPassword()
	{
		$email = Input::get('email');
		$user = User::where('email', $email)->first();
		$resetCode = uniqid();

		if($pr = PasswordReset::active($user->id))
		{
			$pr->delete();
		}

		$pr = new PasswordReset;

		$pr->user_id = $user->id;
		$pr->tmp_password = $resetCode;
		$pr->save();

		Mail::send('emails.password_recovery.tmp_pwd_email', ['user' => $user, 'resetCode' => $resetCode],
			function($message) use ($email)
			{
				$message->to($email, null)->subject('Account Password Reset');
			}
		);
		return Redirect::to('login');
	}

	public function showResetPassword($user_id, $resetCode)
	{
		if(null !== PasswordReset::exists($user_id, $resetCode))
		{
			$user = User::find($user_id);
			return View::make('no_auth.fp_new_password', ['user' => $user, 'resetCode' => $resetCode]);
		}
		else
		{
			return Redirect::to('login');
		}
	}

	public function saveResetPassword()
	{
		$validator = Validator::make(
			Input::all(),
			['password' => 'required|confirmed']
		);

		if(PasswordReset::exists(Input::get('user_id'), Input::get('reset_code')))
		{
			if($validator->passes())
			{
				$user = User::find(Input::get('user_id'));
				$user->password = Input::get('password');
				if($user->save())
				{
					PasswordReset::active($user->id)->delete();
					return Redirect::to('login');
				}
			}
			else
			{
				return Redirect::back()->withInput()->withErrors($validator);
			}
		}
		else
		{
			return Redirect::to('login');
		}
	}


}

<?php

Route::get('test', function()
{
	return Config::get('activities');
});

Route::group(['before' => 'auth'], function()
{
	// logoff route
	Route::get('auth/logout', 'AuthController@logoutUser');


	// Dashboard routes
	Route::get('/', 'DashboardController@index');
	Route::resource('dashboard', 'DashboardController');

	// Event routes
	Route::get('user/{user_id}/events', ['as' => 'user.events.show', 'uses' => 'EventController@showUserEvents']);
	Route::get('event/{event_id}/join', ['as' => 'event.join', 'uses' => 'EventController@joinEvent']);
	Route::resource('event', 'EventController');

	// Account settings routes
	Route::post(
		'account/{user_id}/save_contact_info',
		['as' => 'account.save_contact_info',
		 'uses' => 'AccountController@saveContactInfo']
	);
	Route::post(
		'account/{user_id}/change_password',
		['as' => 'account.change_password',
		 'uses' => 'AccountController@changePassword']
	);
	Route::post(
		'account/{user_id}/save_address_info',
		['as' => 'account.save_address_info',
		 'uses' => 'AccountController@saveAddress']
	);
	Route::get(
		'account/{user_id}/destroy',
		['as' => 'account.remove',
		 'uses' => 'AccountController@destroy']
	);
	Route::resource('account', 'AccountController');

	// Team routes
	Route::get('team/{team_id}/join', ['as' => 'team.join', 'uses' => 'TeamController@join']);
	Route::get('teams/list_teams', ['as' => 'teams.list', 'uses' => 'TeamController@listTeams']);
	Route::resource('teams', 'TeamController');

	Route::get('{username}/friends', 'UserController@showFriends');
	Route::get('{username}/friends/add/{friend_id}', 'UserController@addFriend');
	Route::get('friends/search', 'UserController@search');

	// Notification settings routes
	Route::get('notifications/{user_id}/settings', ['as' => 'notifications.settings.show', 'uses' => 'NotificationsController@edit']);
});

Route::group(['before' => 'guest'], function()
{
	// login and signup routes
	Route::get('login', 'HomeController@showWelcome');
	Route::get('register', 'AuthController@showRegistration');
	Route::post('auth/login', 'AuthController@loginUser');
	Route::resource('auth', 'AuthController');

	// Forgot password routes
	Route::get('forgot_password/index', ['as' => 'forgot_password.index', 'uses' => 'AuthController@showForgotPassword']);
	Route::post(
		'forgot_password/fp_send_email',
		['as' => 'forgot_password.send_tmp_password',
		 'uses' => 'AuthController@sendTempPassword']
	);
	Route::get(
		'forgot_password/reset/{user_id}/{reset_code}',
		['as' => 'forgot_password.show_reset_password',
		 'uses' => 'AuthController@showResetPassword']
	);
	Route::post('forgot_password/save_reset', ['as' => 'forgot_password.save_reset', 'uses' => 'AuthController@saveResetPassword']);
});
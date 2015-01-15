<?php

class PasswordReset extends Eloquent {

	protected $table = 'password_reset';

	public static function exists($user_id, $tmp_password)
	{
		$pr = static::where('user_id', $user_id)->where('tmp_password', $tmp_password)->first();
		return $pr;
	}

	public static function active($user_id)
	{
		$pr = static::where('user_id', $user_id)->first();
		return $pr;
	}

}
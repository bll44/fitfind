@extends('_layouts.no_auth')

@section('content')

<div class="row">
	<div class="col-lg-offset-3 col-lg-6">
		<h2>Password Recovery</h2>
		@if(Session::has('errors'))
		<div class="alert alert-danger">{{ $errors->first('password') }}</div>
		@endif
		{{ Form::open(['route' => 'forgot_password.save_reset', 'role' => 'form']) }}
			<input type="hidden" name="user_id" value="{{ $user->id }}">
			<div class="form-group">
				<label for="email_address">Email Address</label>
				{{ Form::email('email', $user->email, ['class' => 'form-control', 'readonly' => 'readonly']) }}
			</div>
			<div class="form-group">
				<label for="reset_code">Password Reset Code</label>
				{{ Form::text('reset_code', $resetCode, ['class' => 'form-control', 'placeholder' => 'reset code']) }}
			</div>
			<div class="form-group">
				<label for="password">New Password</label>
				{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'new password']) }}
			</div>
			<div class="form-group">
				<label for="password_confirmation">Confirm New Password</label>
				{{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'password again'])}}
			</div>
			{{ Form::submit('Reset Password', ['class' => 'btn btn-default']) }}
		{{ Form::close() }}
	</div>
</div>

@stop
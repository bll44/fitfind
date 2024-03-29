@extends('_layouts.no_auth')

@section('styles')

<style>
body {
	padding-top: 18px;
}
.inline p {
	display: inline;
}

.inline p:not(:first-child) {
	margin-left: 15px;
}

.jumbotron .nav-buttons a {
	width: 200px;
}

#sign-in-form {
	margin-top: 18px;
}

#create-account-link, #forgot-password-link {
	margin-top: 5px;
	font-size: 12pt;
}

#welcome-container {
	margin-top: 120px;
}
</style>

@stop

@section('content')
<div class="col-lg-offset-2 col-lg-8 panel panel-default" id="welcome-container">
	<div class="panel-body">
		<h1>Welcome to FitFind!</h1>
		<p>Find Your Fit Today</p>

		<div class="row">
			<div id="sign-in-form" class="col-lg-12">
				@if(Session::has('login_failed'))
				<div class="alert alert-danger">
					Login failed.
				</div>
				@endif
				{{ Form::open(['url' => 'auth/login', 'role' => 'form', 'id' => 'sign-in-form']) }}

				<div class="form-group">
					{{ Form::label('username_email', 'Username or Email') }}
					{{ Form::text('username_email', null, ['class' => 'form-control', 'placeholder' => 'Enter username or email', 'autofocus' => 'true']) }}
				</div>

				<div class="form-group">
					{{ Form::label('password', 'Password') }}
					{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'password']) }}
				</div>
				<button type="submit" class="sign-in-btn btn btn-primary">Sign in</button>
				{{ Form::close() }}
			</div><!-- / sign-in-form -->
		</div><!-- /.row -->
		<div class="row">
			<div class="col-lg-12">
				<p id="create-account-link" class="text-right">{{ link_to('register', 'Sign Up', ['class' => 'small text-primary']) }}</p>
				<p id="forgot-password-link" class="text-right">{{ link_to('forgot_password/index', 'Forgot Password?', ['class' => 'small text-primary']) }}</p>
			</div>
		</div><!-- /.row -->
	</div>
	<!-- /.panel-body -->
</div>
<!-- /.panel /#welcome-container -->

@stop

@section('scripts')

@stop
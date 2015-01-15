@extends('_layouts.no_auth')

@section('styles')

<style>
.back2login-btn {
	margin-bottom: 10px;
}

.checkbox {
	display: inline;
	padding-right: 15px;
}

.register-btn {
	font-size: 10pt;
}
.panel-heading #main-title {
	padding: 10px 0;
	font-size: 14pt;
}
.not-visible {
	visibility: hidden;
}
</style>

@stop

@section('content')

@if(Session::has('validation_errors'))
<div class="alert alert-danger">

	@foreach(Session::pull('validation_errors') as $e)

	<p>{{ $e }}</p>

	@endforeach

</div>
@endif

<div class="row">
	<div class="col-lg-offset-3 col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title" id="back-link">
					<a href="{{ URL::to('login') }}"><i class="fa fa-arrow-left"></i>&nbsp;Back to login</a>
				</h3>
				<h3 class="panel-title" id="main-title">
					Register for FitFind
				</h3>
			</div>
			<div class="panel-body">
				{{ Form::open(['route' => 'auth.store', 'role' => 'form']) }}
				<div class="form-group">
					<label for="displayname">Name</label>
					{{ Form::text('displayname', null, ['class' => 'form-control', 'placeholder' => 'Name']) }}
				</div>
				<div class="form-group">
					<label for="username">Username</label>
					{{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username']) }}
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					{{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
				</div>

				<div class="form-group">
					<label for="password">Password</label>
					{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
				</div>
				<div class="form-group">
					<label for="password_confirmation" class="sr-only">Confirm password</label>
					{{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm password']) }}
				</div>
				{{ Form::submit('Register', ['class' => 'btn btn-default pull-right']) }}
				{{ Form::close() }}
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.column -->
</div>
<!-- /.row -->

@stop

@section('scripts')


@stop
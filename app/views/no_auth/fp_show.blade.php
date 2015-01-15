@extends('_layouts.no_auth')

@section('content')

<div class="row">

<div class="col-lg-offset-3 col-lg-6">
	<h2>FitFind Password Recovery</h2>

	{{ Form::open(['route' => 'forgot_password.send_tmp_password', 'role' => 'form']) }}

		<div class="form-group">
			<label for="email">Enter the email address associated with your account</label>
			{{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email address']) }}
		</div>
		{{ Form::submit('Send Recovery Email', ['class' => 'btn btn-default']) }}

	{{ Form::close() }}
	<!-- /.fp send temp password form -->

</div>
<!-- /.column -->

</div>
<!-- /.row -->

@stop
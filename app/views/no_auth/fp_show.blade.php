@extends('_layouts.no_auth')

@section('content')

{{ HTML::style('css/fp_registration_panel.css') }}


<div class="row">
	<div class="col-lg-offset-3 col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title" id="back-link">
					<a href="{{ URL::to('login') }}"><i class="fa fa-arrow-left"></i>&nbsp;Back to login</a>
				</h3>
				<h3 class="panel-title" id="main-title">
					FitFind Password Recovery
				</h3>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				{{ Form::open(['route' => 'forgot_password.send_tmp_password', 'role' => 'form']) }}
				<div class="form-group">
					<label for="email">Email associated with your FitFind account</label>
					{{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email address']) }}
				</div>
				{{ Form::submit('Send Recovery Email', ['class' => 'btn btn-primary form-submit-btn']) }}
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
@extends('_layouts.master')

@section('styles')
<style>
textarea {
	resize: none;
}
</style>
@stop

@section('content')

<div class="row">
	<div class="col-lg-offset-3 col-lg-6">
		<h1>Create Team</h1>
		<div class="panel panel-default">
			<div class="panel-body">
			{{ Form::open(['route' => 'teams.store', 'role' => 'form']) }}

			<div class="form-group">
				{{ Form::label('team_name', 'Team Name') }}
			    {{ Form::text('team_name', null, ['class' => 'form-control', 'placeholder' => 'Team Name']) }}
			</div>
			<!-- /.form-group -->

			<div class="form-group">
				{{ Form::label('team_description', 'Team Description') }}
				{{ Form::textarea('team_description', null, ['class' => 'form-control', 'placeholder' => 'Team Description', 'resize' => 'none']) }}
			</div>
			<!-- /.form-group -->
		  	{{ Form::submit('Create Team', ['class' => 'btn btn-primary']) }}
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

@stop
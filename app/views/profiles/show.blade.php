@extends('_layouts.master')

@section('styles')
<style>


</style>
@stop

@section('content')
<h1>profiles.show</h1>
<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					Profile&nbsp;
					{{-- <small><a href="#" class="pull-right" id="edit-profile-link"><i class="fa fa-edit"></i> Edit</a></small> --}}
				</h3>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<p>Name: {{ $user->displayname }}</p>
						<p>Bio: {{ $user->profile->bio }}</p>
						<p>Location: {{ $user->profile->location }}</p>
					</div>
				</div>
				<!-- /.row -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.column -->
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					{{ link_to_route('teams.index', 'Teams') }}
				</h3>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<ul class="list-group">
						@foreach($user->teams as $team)
						<li class="list-group-item">{{ link_to_route('teams.show', $team->name, [$team->id]) }}</li>
						@endforeach
						</ul>
						<!-- /.list-group -->
					</div>
				</div>
				<!-- /.row -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.column -->
</div>
<!-- /.row -->

<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					Pending Requests
				</h3>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<ul class="list-group">
						@foreach($pending_approvals as $pa)
						<li class="list-group-item">{{ link_to_route('teams.show', $pa->team->name, [$pa->team->id]) }}</li>
						@endforeach
						</ul>
						<!-- /.list-group -->
					</div>
				</div>
				<!-- /.row -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.column -->
</div>
<!-- /.row -->

<div class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Update Profile Information</h4>
			</div>
			<!-- /.modal-header -->
			<div class="modal-body">
				{{ Form::open(['route' => 'profile.update', 'method' => 'PATCH']) }}
				<div class="form-group">
					<label for="bio">Bio</label>
					{{ Form::textarea('bio', $user->profile->bio, ['class' => 'form-control']) }}
				</div>
				<!-- /.form-group -->
				<div class="form-group">
					<label for="location">Location</label>
					{{ Form::text('location', $user->profile->location, ['class' => 'form-control']) }}
				</div>
				<!-- /.form-group -->
				{{ Form::submit('Save & Update') }}
				{{ Form::close() }}
			</div>
			<!-- /.modal-body -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
			<!-- /.modal-footer -->
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@stop

@section('scripts')
<script>

</script>
@stop
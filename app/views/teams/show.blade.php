@extends('_layouts.master')

@section('styles')
@stop

@section('content')
<h1>{{ $team->name }} overview</h1>
<div class="row">

	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					{{ $team->name }}
				</h3>
				<!-- /.panel-title -->
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="team-description-container">
					{{ $team->description }}
				</div>
				<!-- /.team-description-container -->
			</div>
			<!-- /.panel-body -->

			{{--
			<div class="panel-footer">

			</div>
			<!-- /.panel-footer -->
			--}}

		</div>
		<!-- /.panel -->
	</div>
	<!-- /.column -->

	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					Team Members
				</h3>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<ul class="list-group">
				@foreach($team->members as $member)
					@if($member->id === $team->team_leader_id)
					<li class="list-group-item">
						<a href="{{ URL::route('profile.show', [$member->username]) }}">
							<i class="fa fa-asterisk"></i> {{ $member->displayname }}
						</a>
					</li>
					@else
					<li class="list-group-item">{{ link_to_route('profile.show', $member->displayname, [$member->username]) }}</li>
					@endif
				@endforeach
				</ul>
				<!-- /.list-group -->
				<p class="italic"><i class="fa fa-asterisk"></i> = Team Leader</p>
			</div>
			<!-- /.panel-body -->

			{{--
			<div class="panel-footer">

			</div>
			<!-- /.panel-footer -->
			--}}

		</div>
		<!-- /.panel -->
	</div>
	<!-- /.column -->

</div>
<!-- /.row -->

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					Team's Events
				</h3>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				@if($team->events->count() < 1)
				<p class="alert alert-warning">No events scheduled as of now.</p>
				@else
				@foreach($team->events as $event)
				<div class="panel panel-default">
					<div class="panel-body">
						<p>{{ link_to_route('event.show', $event->displayname, [$event->id]) }}</p>
					</div>
				</div>
				@endforeach
				@endif
			</div>
			<!-- /.panel-body -->

			{{--
			<div class="panel-footer">

			</div>
			<!-- /.panel-footer -->
			--}}

		</div>
		<!-- /.panel -->
	</div>
	<!-- /.column -->
</div>
<!-- /.row -->
@stop

@section('scripts')

@stop
@extends('_layouts.master')

@section('content')

<h1>Events for {{ $user->displayname }}</h1>

<div class="row">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist" id="my-event-tab">
		<li role="presentation" class="active"><a href="#individual-events" role="tab" data-toggle="tab">Individual</a></li>
		<li role="presentation"><a href="#team-events" role="tab" data-toggle="tab">Team</a></li>
	</ul><!-- /.nav-tabs -->
</div><!-- /.row -->

<!-- Tab panes -->
<div class="tab-content">

	<!-- Individual events -->
	<div role="tabpanel" class="tab-pane active" id="individual-events">
		<h2>Joined</h2>
		@foreach($joined_events as $je)
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">{{ $je->displayname }}</h3>
			</div><!-- /.panel-heading -->
			<div class="panel-body">
				<p>Organizer: {{ $je->organizer->displayname }}</p>
				<p>Max Participants: {{ $je->max_participants }}</p>
				<p>Start Time: {{ $je->f_startTime() }}</p>
				<p>End Time: {{ $je->f_endTime() }}</p>
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
		@endforeach

		<h2>Created</h2>
		@foreach($created_events as $ce)
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">{{ $ce->displayname }}</h3>
			</div><!-- /.panel-heading -->
			<div class="panel-body">
				<p>Organizer: {{ $ce->organizer->displayname }}</p>
				<p>Max Participants: {{ $ce->max_participants }}</p>
				<p>Start Time: {{ $ce->f_startTime() }}</p>
				<p>End Time: {{ $ce->f_endTime() }}</p>
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
		@endforeach
	</div><!-- /.tab-pane -->
	<!-- / Individual events -->

	<!-- Team events -->
	<div role="tabpanel" class="tab-pane" id="team-events">
		<h2>Joined</h2>
		@foreach($joined_team_events as $jte)
		<h4>{{ key($joined_team_events) }}</h4>
		@foreach($jte as $te)
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">{{ $te->displayname }}</h3>
			</div><!-- /.panel-heading -->
			<div class="panel-body">
				<p>Organizer: {{ $te->organizer->displayname }}</p>
				<p>Max Participants: {{ $te->max_participants }}</p>
				<p>Start Time: {{ $te->f_startTime() }}</p>
				<p>End Time: {{ $te->f_endTime() }}</p>
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
		@endforeach
		@endforeach

		<h2>Created</h2>
		@foreach($created_team_events as $cte)
		<h4>{{ key($created_team_events) }}</h4>
		@foreach($cte as $te)
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">{{ $te->displayname }}</h3>
			</div><!-- /.panel-heading -->
			<div class="panel-body">
				<p>Organizer: {{ $te->organizer->displayname }}</p>
				<p>Max Participants: {{ $te->max_participants }}</p>
				<p>Start Time: {{ $te->f_startTime() }}</p>
				<p>End Time: {{ $te->f_endTime() }}</p>
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
		@endforeach
		@endforeach
	</div><!-- /.tab-pane -->
	<!-- / Team events -->
</div><!-- /.tab-content -->



@stop

@section('scripts')

<script>
$(document).ready(function() {
	$('#my-event-tab a[href="#individual-events"').tab('show');
});
</script>

@stop
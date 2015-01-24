@extends('_layouts.master')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1>Team Events</h1>
		@foreach($team_events as $te)
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">{{ $te->team_name }}</h3>
			</div>
			<div class="panel-body">
				@foreach($te->events as $e)
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">{{ $e->displayname }}</h3>
					</div>
					<div class="panel-body">
						<p>Maximum Players: {{ $e->max_participants }}</p>
						<p>Start Time: {{ $e->f_startTime() }}</p>
						<p>Estimated End Time: {{ $e->f_endTime() }}</p>
					</div>
				</div>
				@endforeach
			</div>
		</div>
		<!-- /.panel -->
		@endforeach
	</div>
	<!-- /.column -->
</div>
<!-- /.row -->

@stop
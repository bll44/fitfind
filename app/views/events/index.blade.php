@extends('_layouts/master')

@section('styles')

<style>

#events-table {
	cursor: pointer;
}

</style>

@stop

@section('content')

<h2>Events</h2>

<hr>

<div class="table-responsive">
	<table class="table table-striped table-hover" id="events-table">
		<thead>
			<th>Name</th>
			<th>Organizer</th>
			<th>Max Participants</th>
			<th>Team Event</th>
			<th>Start Time</th>
			<th>End Time</th>
			<th>Venue</th>
		</thead>
		<tbody>
		@foreach($events as $event)
			@if($event->organizer->id !== Auth::user()->id && ! in_array($event->id, $event_ids) && ! in_array($event->id, $team_event_ids))

			<tr class="event" data-event_id="{{ $event->id }}">
				<td>{{ $event->displayname }}</td>
				<td>{{ $event->organizer->displayname }}</td>
				<td>{{ $event->max_participants }}</td>
				<td>{{ ! $event->team_event ? 'No' : 'Yes' }}</td>
				<td>{{ date_format(date_create($event->start_time), 'M jS @ h:ia') }}</td>
				<td>{{ date_format(date_create($event->end_time), 'M jS @ h:ia') }}</td>
				<td>{{ ! $event->venue ? 'To Be Determined' : $event->venue->name }}</td>
			</tr>

			@endif
		@endforeach
		</tbody>
	</table>
</div>
<!-- /.table-responsive -->

@stop

@section('scripts')
<script>

$('#events-table tr.event').click(function() {
	window.location = "{{ URL::to('event') }}" + "/" + $(this).data('event_id');
});

</script>

@stop
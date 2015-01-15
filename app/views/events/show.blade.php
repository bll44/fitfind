@extends('_layouts.master')

@section('content')
<h1>{{ $event->displayname }}</h1>

<p>Organizer: {{ $event->organizer->displayname }}</p>
<p>Max Participants: {{ $event->max_participants }}</p>
<p>Team Event: {{ ! $event->team_event ? 'No' : 'Yes' }}</p>
<p>Start Time: {{ $event->f_startTime() }}</p>
<p>End Time: {{ $event->f_endTime() }}</p>
<p>Venue: {{ ! $event->venue ? 'TBD' : $event->venue->name }}</p>

@if( ! $event->team_event)
	{{ link_to_route('event.join', 'Join this Event', [$event->id]) }}
@else
	{{ Form::open(['route' => ['event.join', $event->id], 'method' => 'get', 'role' => 'form', 'id' => 'join-with-team-form']) }}
	{{ Form::hidden('team_id', 0, ['id' => 'team_id-field']) }}
	{{ Form::submit('Join this Event with a Team', ['class' => 'btn-link']) }}
	{{ Form::close() }}

	<div class="row">
		<div class="col-lg-5">
			<div class="input-group">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" data-toggle="modal" data-target="#choose-team-modal">
						Choose a Team
					</button>
				</span>
				<input type="text" class="form-control" id="team-field" readonly="readonly">
			</div><!-- /.input-group -->
		</div><!-- /.col-lg-4 -->
	</div><!-- /.row -->
@endif

<div class="modal fade" id="choose-team-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Choose a Team</h4>
			</div><!-- /.modal-header -->
			<div class="modal-body">
				<div class="list-group">
				@foreach($teams as $team)

				<a href="#" data-team_id="{{ $team->id }}" data-team_name="{{ $team->name }}" class="list-group-item team-list-item">{{ $team->name }}</a>

				@endforeach
				</div>
			</div><!-- /.modal-body -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div><!-- /.modal-footer -->
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop

@section('scripts')

<script>

	$('#join-with-team-form').submit(function() {
		if($('#team_id-field').val() == 0)
		{
			alert('You must select a team to use this option.');
			return false;
		}

		return true;
	});

	$('.team-list-item').click(function() {
		$('.team-list-item').each(function() {
			$(this).removeClass('active');
		});
		$(this).addClass('active');
		var teamId = $(this).data('team_id');
		var teamName = $(this).data('team_name');
		$('#team_id-field').val(teamId);
		$('#team-field').val(teamName);
	});

</script>

@stop
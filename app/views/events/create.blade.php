@extends('_layouts.master')

@section('styles')

<style>

	.activity-panel {
		border: 2px solid;
		padding: 10px;
		margin-top: 10px;
		margin-bottom: 10px;
		cursor: pointer;
	}

	.activity-panel:hover {
		background-color: #f3f3f3;
	}

	.time-container div {
		margin: 10px 0;
	}

</style>

@stop

@section('content')

{{ Form::open(['route' => 'event.store', 'role' => 'form', 'id' => 'create-event-form']) }}
{{ Form::hidden('activity', null, ['id' => 'activity-input']) }}
<div class="event-container">

	<h1>Events</h1>
	@foreach($activities as $activity)
	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 activity">
		<div class="activity-panel" id="{{ $activity }}" data-activity="{{ $activity }}" data-toggle="modal" data-target="#new-event-modal">
			{{ $activity }}
		</div>
	</div>
	@endforeach

</div>
<!-- /.event-container -->


<div class="modal fade" id="new-event-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">New [ACTIVITY] Event</h4>
			</div>
			<!-- /.modal-header -->
			<div class="modal-body">
				<div class="new-event-form-container">
					{{ Form::open(['route' => 'event.store', 'role' => 'form', 'id' => 'new-event-form']) }}
					{{ Form::hidden('organizer', Auth::user()->id) }}
					<div class="form-group">
						{{ Form::label('activity', 'Activity') }}
						{{ Form::text('activity', null, ['class' => 'form-control',
							'placeholder' => 'Activity',
							'readonly' => 'readonly',
							'id' => 'activity-field']) }}
					</div>
					<!-- /.form-group -->

					<div class="form-group">
						{{ Form::label('organizer', 'Organizer') }}
						{{ Form::text('organizer', Auth::user()->displayname,
							['class' => 'form-control',
							 'placeholder' => 'Organizer',
							 'disabled' => 'disabled',
							 'id' => 'organizer-field']) }}
					</div>
					<!-- /.form-group -->

					<div class="form-group">
						{{ Form::label('start_time', 'Start Time') }}
						{{ Form::text('start_time', null,
							['class' => 'form-control',
							 'placeholder' => 'Start Time',
							 'id' => 'start_time-field']) }}
					</div>
					<!-- /.form-group -->

					<div class="form-group">
						{{ Form::label('end_time', 'End Time') }}
						{{ Form::text('end_time', null,
							['class' => 'form-control',
							 'placeholder' => 'End Time',
							 'id' => 'end_time-field']) }}
					</div>
					<!-- /.form-group -->

					<div class="checkbox">
						<label>
							<input name="team_event" type="checkbox" id="team-event-checkbox"> Team Event
						</label>
					</div>
					<!-- /.team-event-checkbox -->

					<div class="form-group">
						{{ Form::label('max_participants', 'Maximum Participants') }}
						<input type="number" name="max_participants" class="form-control" id="max_participants-field" placeholder="Maximum Participants" min="1">
					</div>
					<!-- /.form-group -->

					<div class="form-group">
						{{ Form::label('venue', 'Venue') }}
						<select name="venue" class="form-control">
							<option value="0">To Be Determined</option>
							@foreach($venues as $venue)
							<option value="{{ $venue->id }}">{{ $venue->name }}</option>
							@endforeach
						</select>
					</div>
					<!-- /.form-group -->

				</div>
				<!-- /.new-event-form-container -->
			</div>
			<!-- /.modal-body -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary">Publish Event</button>
				{{ Form::close() }}
				<!-- /.new-event-form -->
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
$(document).ready(function() {
	$('#start_time-field').datetimepicker({ format: 'Y-m-d H:i' });
	$('#end_time-field').datetimepicker({ format: 'Y-m-d H:i' });
});

$('#new-event-modal').on('show.bs.modal', function(e) {
	var text = $('#new-event-modal h4.modal-title').text();
	var activity = $(e.relatedTarget).data('activity');
	var modalTitle = text.replace('[ACTIVITY]', activity);

	// set the modal title
	$('#new-event-modal h4.modal-title').text(modalTitle);
	$('#activity-field').val(activity);
});
</script>
@stop
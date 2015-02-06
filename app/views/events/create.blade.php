@extends('_layouts.master')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h2>Create a new event</h2>
	</div>
	<!-- /.column -->
</div>
<!-- /.row -->
<hr>

<div class="row">

	<div class="col-lg-offset-1 col-md-offset-1 col-lg-6 col-md-6 col-sm-12 col-xs-12">

		<div class="create-event-form-container">
			{{ Form::open(['route' => 'event.store', 'role' => 'form', 'id' => 'create-event-form']) }}
				<div class="form-group">
					{{ Form::label('event-type', 'Type of Event') }}
					{{ Form::text('event-type', null, ['class' => 'form-control', 'placeholder' => 'Baseball, Hiking, Running, etc']) }}
				</div>
				<!-- /.form-group -->

				<div class="form-group">
					{{ Form::label('event-name', 'Name the event') }}
					{{ Form::text('event-name', null, ['class' => 'form-control', 'placeholder' => 'Name the event as it will be displayed']) }}
				</div>
				<!-- /.form-group -->

				<div class="row">
					<div class="checkbox col-lg-6 col-md-6">
						<label for="event-teams-only">
							<input type="checkbox" name="event-teams-only" id="team-event-checkbox"> Team event
						</label>
					</div>
					<!-- /.checkbox -->
					<div class="form-group col-lg-6 col-md-6">
						{{ Form::label('event-max-participants', 'Maximum # of people') }}
						{{ Form::number('event-max-participants', null,
							['class' => 'form-control',
							 'placeholder' => 'Maximum participants',
							 'id' => 'max-participants-number-field']) }}
					</div>
					<!-- /.form-group -->
				</div>
				<!-- /.row -->

				<div class="row hidden" id="team-selection-container">
					<div class="form-group col-lg-12 col-md-12">
						<p>
							<label>Which team is playing in this event?</label>
							<button type="button" data-toggle="modal" data-target="#team-modal" class="btn btn-warning btn-block">
								Choose a team
							</button>
						</p>
						<input type="text" class="form-control" readonly="true" id="team-text-field" placeholder="Team name">
						<input type="hidden" name="event-team" id="event-team">
					</div>
					<!-- /.form-group -->
				</div>
				<!-- /.row -->

				<div class="row">
					<div class="form-group col-lg-6">
						{{ Form::label('event-start-time', 'When does it begin?') }}
						{{ Form::text('event-start-time', null, ['class' => 'form-control date-time-picker', 'placeholder' => 'Time the event starts']) }}
					</div>
					<!-- /.form-group -->

					<div class="form-group col-lg-6">
						{{ Form::label('event-end-time', 'When does it end?') }}
						{{ Form::text('event-end-time', null, ['class' => 'form-control date-time-picker', 'placeholder' => 'Time the event ends']) }}
					</div>
					<!-- /.form-group -->
				</div>
				<!-- /.row -->

				<div class="form-group">
					<p>
						<label>Where is the event taking place?</label>
						<button type="button" data-toggle="modal" data-target="#venue-modal" class="btn btn-warning btn-block">
							Choose a venue
						</button>
					</p>
					<input type="text" class="form-control" readonly="true" id="venue-text-field" placeholder="Venue name">
					<input type="hidden" name="event-venue" id="event-venue">
				</div>
				<!-- /.form-group -->

				<div class="form-group">
					{{ Form::label('event-organizer', 'Event is organized by') }}
					{{ Form::text('event-organizer', Auth::user()->displayname, ['class' => 'form-control', 'disabled' => true]) }}
				</div>
				<!-- /.form-group -->

				{{ Form::submit('Create event', ['class' => 'btn btn-primary btn-lg']) }}
			{{ Form::close() }}
		</div>
		<!-- /.create-event-form-container -->

	</div>
	<!-- /.column -->

</div>
<!-- /.row -->

@include('events._partials.venue_modal')
@include('events._partials.team_modal')

@stop


@section('scripts')

<script>

$('#team-event-checkbox').click(function() {
	if($(this).is(':checked'))
	{
		$('#team-selection-container').removeClass('hidden');
	}
	else if( ! $(this).is(':checked'))
	{
		$('#team-selection-container').addClass('hidden');
	}
});

$('.select-team-button').click(function() {
	var team = {
		id: $(this).closest('div.thumbnail').data('team-id'),
		name: $(this).closest('div.thumbnail').data('team-name'),
		description: $(this).closest('div.thumbnail').data('team-description'),
	};
	$('#team-text-field').val(team.name);
	$('#event-team').val(team.id);
	$('#team-modal').modal('hide');
});

$('.select-venue-button').click(function() {
	var venue = {
		id: $(this).closest('div.thumbnail').data('venue-id'),
		name: $(this).closest('div.thumbnail').data('venue-name'),
		description: $(this).closest('div.thumbnail').data('venue-description'),
	};
	$('#venue-text-field').val(venue.name);
	$('#event-venue').val(venue.id);
	$('#venue-modal').modal('hide');
});

$(document).ready(function() {
	$('.date-time-picker').datetimepicker();
});
</script>

@stop
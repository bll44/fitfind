@extends('_layouts.master')

@section('styles')

@stop

@section('content')

<h2>All Teams</h2>
@foreach($teams as $team)

@if( ! in_array($team->id, $my_teams))
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">{{ link_to_route('teams.show', $team->name, [$team->id]) }}<span class="pull-right"><i class="fa fa-asterisk"></i> {{ User::find($team->team_leader_id)->displayname }}</span></h3>
		{{ Form::hidden('team_id', $team->team_leader_id) }}
	</div>
	<div class="panel-body">
		<p>{{ $team->description }}</p>
	</div>
	<!-- /.panel-body -->
	<div class="panel-footer">
		@if( ! in_array($team->id, $requested))
		<button type="button" class="btn btn-default request-button" data-team-id="{{ $team->id }}">Request to Join This Team</button>
		@else
		<button type="button" class="btn btn-success request-button" data-team-id="{{ $team->id }}" data-cancel-request="yes">Request Sent&nbsp;&nbsp;<i class="fa fa-check"></i></button>
		@endif
	</div>
	<!-- /.panel-footer -->
</div>
@endif

@endforeach

@stop

@section('scripts')

<script>

$('.request-button').click(function() {
	console.log($(this).data());
	// return;
	var team_id = $(this).data('team-id');
	if($(this).data('cancel-request') === 'yes')
	{
		$(this).html('Canceling Request <i class="fa fa-spin fa-circle-o-notch"></i>');
		$.ajax({
			url: "{{ URL::route('team.cancel_join') }}",
			type: 'POST',
			data: { team: team_id },
			dataType: 'json',
			context: this,
			success: function(data) {
				console.log(data);
				if(data.status_code === 200)
				{
					$(this).addClass('btn-default').html('Request to Join This Team');
					$(this).removeClass('btn-success');
					$(this).removeClass('btn-danger');
					$(this).removeData('cancel-request');
				}
			}
		});
		return;
	}

	$(this).html('Sending Request <i class="fa fa-spin fa-circle-o-notch"></i>');
	$.ajax({
		url: "{{ URL::route('team.join') }}",
		type: 'POST',
		data: { team: team_id },
		dataType: 'json',
		context: this,
		success: function(data) {
			if(data.status_code === 200)
			{
				$(this).addClass('btn-success');
				$(this).removeClass('btn-default');
				$(this).html('Request Sent&nbsp;&nbsp;<i class="fa fa-check"></i>');
				$(this).data('cancel-request', 'yes');
			}
		}
	});
});

$('.request-button').hover(function() {
	if($(this).hasClass('btn-success'))
	{
		$(this).removeClass('btn-success').addClass('btn-danger').html('Take Back this Request&nbsp;&nbsp;<i class="fa fa-reply"></i>');
	}
}, function() {
	if($(this).hasClass('btn-danger'))
	{
		$(this).removeClass('btn-danger').addClass('btn-success').html('Request Sent&nbsp;&nbsp;<i class="fa fa-check"></i>');
	}
});

</script>

@stop
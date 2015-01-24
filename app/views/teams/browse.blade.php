@extends('_layouts.master')

@section('styles')

@stop

@section('content')

<h2>All Teams</h2>
@foreach($teams as $team)
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
		<button type="button" class="btn btn-default request-button" data-team-id="{{ $team->id }}">Request to Join This Team</button>
	</div>
	<!-- /.panel-footer -->
</div>
@endforeach

@stop

@section('scripts')

<script>

$('.request-button').click(function() {
	$(this).html('Sending Request <i class="fa fa-spin fa-circle-o-notch"></i>');
	var team_id = $(this).data('team-id');
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
			}
		}
	});
});

</script>

@stop
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
		<p>{{ link_to_route('team.join', 'Request To Join', [$team->id]) }}</p>
	</div>
	<!-- /.panel-footer -->
</div>
@endforeach

@stop


@extends('_layouts.master')

@section('styles')

@stop

@section('content')

<h2>All Teams</h2>
@foreach($teams as $team)
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title">{{ $team->name }}</h3>
	    {{ Form::hidden('team_id', $team->team_leader_id) }}
	  </div>
	  <div class="panel-body">
	    {{ $team->description }}<br />
	    Maximum Number of Players: {{ $team->max_players }} <br />
	    Team Leader: {{ User::find($team->team_leader_id)->displayname }}<br />
	    {{ link_to_route('team.join', 'Request To Join', [$team->id]) }}
	  </div>
	</div>
@endforeach

@stop


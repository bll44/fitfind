@extends('_layouts.master')

@section('styles')

@stop

@section('content')

<h2>Created Teams</h2>
@foreach($created_teams as $created_team)
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title">{{ $created_team->name }}</h3>
	  </div>
	  <div class="panel-body">
	    {{ $created_team->description }}<br />
	    Maximum Number of Players: {{ $created_team->max_players }} <br />
	    Team Leader: {{ $team_leader->displayname }}<br />
	  </div>
	</div>
@endforeach

<h2>Joined Teams</h2>
@foreach($joined_teams as $team)
	@if(Auth::user()->id != $team->team_leader_id)
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">{{ $team->name }}</h3>
		  </div>
		  <div class="panel-body">
		    {{ $team->description }}<br />
		    Maximum Number of Players: {{ $team->max_players }} <br />
		    Team Leader: {{ User::find($team->team_leader_id)->displayname }}<br />
		  </div>
		</div>
	@endif
@endforeach

@stop

@stop
@extends('_layouts.master')

@section('styles')

@stop

@section('content')

{{ Form::open(array('route' => 'teams.store')) }}

    {{ Form::label('teamName', 'Team Name') }}
    {{ Form::text('teamName') }}

  	{{ Form::label('teamDescription', 'Team Description') }}
  	{{ Form::text('teamDescription') }}
  
  	{{ Form::label('lockTeam', 'Locked') }}
  	{{ Form::checkbox('lockTeam', 'yes', true) }}
  
  	{{ Form::submit('Create Team') }}

{{ Form::close() }}

@stop

@stop
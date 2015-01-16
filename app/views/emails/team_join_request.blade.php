@extends('_layouts.email.master')

@section('title')

<h2>Team Join Request</h2>

@stop

@section('body')

<p>Hi {{ $teamLeader->displayname }},</p>
<p>{{ $candidate->displayname }} would like to join your team '{{ $team->name }}'. Please sign in to FitFind to accept or deny this request.</p>

@stop

@stop
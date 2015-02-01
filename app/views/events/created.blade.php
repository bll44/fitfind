@extends('_layouts.master')

@section('content')

<div class="alert alert-success">Event {{ $event->displayname }} @ {{ $event->venue->name }} created.</div>

@stop


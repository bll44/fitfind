@extends('_layouts.master')

@section('content')

<div class="alert alert-success">Event {{ $event->displayname }} @ {{ $event->venue->name }} created.</div>

<div>
	{{ link_to_route('user.events.show', 'Back to My Events', [Auth::user()->id]) }}
</div>

@stop


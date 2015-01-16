@extends('_layouts.master')

@section('styles')

@stop

@section('content')

<h1>My Teams</h1>

@foreach($teams as $team)
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
		<div class="panel panel-default">
		@if($team->team_leader_id === Auth::user()->id)
		<div class="panel-heading">
			<h3 class="panel-title">{{ $team->name }}<span class="pull-right"><i class="fa fa-asterisk"></i></span></h3>
		</div>
		<!-- /.panel-heading -->
		@else
		<div class="panel-heading">
			<h3 class="panel-title">{{ $team->name }}</h3>
		</div>
		@endif
			<div class="panel-body">
			{{ $team->description }}
			</div>
			<!-- /.panel-body -->
			<div class="panel-footer">
			{{ link_to('#', 'View Team Members') }}
			</div>
			<!-- /.panel-footer -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.column -->

@endforeach

@stop

@stop
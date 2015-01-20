@extends('_layouts/master')

@section('styles')

<style>

#events-table {
	cursor: pointer;
}

</style>

@stop

@section('content')

<h2>All Events</h2>

<hr>

@foreach($events as $event)
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">{{ link_to_route('event.show', $event->displayname, [$event->id]) }}</h3>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				@if($event->team_event)
				<p>Teams only: Yes</p>
				@else
				<p>Teams only: No</p>
				@endif
			</div>
			<!-- /.panel-body -->
			<div class="panel-footer">
				{{ link_to_route('event.join', 'Join This Event', [$event->id], ['class' => 'btn btn-primary']) }}
			</div>
			<!-- /.panel-footer -->
		</div>
		<!-- /.panel -->

	</div>
	<!-- /.column -->
</div>
<!-- /.row -->
@endforeach

@stop

@section('scripts')
<script>

</script>

@stop
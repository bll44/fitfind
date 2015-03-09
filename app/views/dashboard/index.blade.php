@extends('_layouts.master')

@section('styles')

<style>

.modal-content {
	padding: 15px;
}

</style>

@stop

@section('content')

<h1 class="page-title">Dashboard</h1>

<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Events</h3>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<h2>{{ link_to_route('user.events.show', 'View My Events', [Auth::user()->id]) }}</h2>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /column -->
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Teams</h3>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<h2>{{ link_to_route('teams.index', 'View My Teams') }}</h2>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /column -->
</div>
<!-- /.row -->

@stop

@section('scripts')

<script>

$('.help-link').popover();

</script>

@stop
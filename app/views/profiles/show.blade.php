@extends('_layouts.master')

@section('styles')
<style>


</style>
@stop

@section('content')

<div class="row">
	<div class="col-lg-offset-3 col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					{{ $user->displayname }}
				</h3>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				{{ $user->street }}
			</div>
			<!-- /.panel-body -->
			<div class="panel-footer">

			</div>
			<!-- /.panel-footer -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.column -->
</div>
<!-- /.row -->

@stop

@section('scripts')
<script>

</script>
@stop
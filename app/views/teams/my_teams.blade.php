@extends('_layouts.master')

@section('styles')

@stop

@section('content')

<h1>
	My Teams
	@if(count($approvals) > 0)
	<small><a href="#" id="request-approval-link">{{ count($approvals) }} team approvals needed</a></small>
	@endif
</h1>

@if($teams->count() > 0)
	@foreach($teams as $team)
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="panel panel-default">
			@if($team->team_leader_id === Auth::user()->id)
			<div class="panel-heading">
				<h3 class="panel-title">{{ link_to_route('teams.show', $team->name, [$team->id]) }}<span class="pull-right"><i class="fa fa-asterisk"></i></span></h3>
			</div>
			<!-- /.panel-heading -->
			@else
			<div class="panel-heading">
				<h3 class="panel-title">{{ link_to_route('teams.show', $team->name, [$team->id]) }}</h3>
			</div>
			@endif
				<div class="panel-body">
				{{ $team->description }}
				</div>
				<!-- /.panel-body -->
				<div class="panel-footer">
				{{ link_to_route('teams.show', 'View Team Members', [$team->id]) }}
				</div>
				<!-- /.panel-footer -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.column -->

	@endforeach
@elseif($teams->count() < 1)
	<h3>You are not on any teams!</h3>
@endif

<div class="modal fade" id="approval-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Team Approval Requests</h4>
			</div>
			<!-- /.modal-header -->
			<div class="modal-body">
				<div id="approval-requests-container" class="hidden">
					<table class="table">
						<thead>
							<th>User</th>
							<th>Team</th>
							<th></th>
						</thead>
						<!-- /.table headings -->
						<tbody class="approval-rows">

						</tbody>
						<!-- /.table rows -->
					</table>
					<!-- /.table -->
				</div>
				<!-- /#approval-requests-container -->
			</div>
			<!-- /.modal-body -->
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@stop

@section('scripts')

<script>

$('#request-approval-link').click(function(event) {

	$.ajax({
		url: "{{ URL::route('get.request_approvals') }}",
		type: 'GET',
		dataType: 'json'
	}).done(function(data) {
		if(data.hasApprovals)
		{
			// make approvals table visible
			$('#approval-requests-container').removeClass('hidden');
			for(var i in data.approvals)
			{
				console.log(data.approvals[i]);
				$('.approval-rows').append(
					'<tr data-approval-id="' + data.approvals[i].approval_id + '">'
					+ '<td>' + data.approvals[i].user.displayname + '</td>'
					+ '<td>' + data.approvals[i].team.name + '</td>'
					+ '<td>'
						+ '<a href="' + data.approvals[i].approve_url + '" class="btn btn-default">Approve</a>&nbsp;'
						+ '<a href="' + data.approvals[i].deny_url + '" class="btn btn-danger">Deny</a>'
					+ '</td>'
					+' </tr>'
				);
			}
		}
	});
	$('#approval-modal').modal('show');

	event.preventDefault();
});

</script>

@stop




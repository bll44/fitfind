@extends('_layouts.master')

@section('styles')

<style>

.input-group {
	margin: 10px 0;
}

.search-results-container {
	margin-bottom: 20px;
}

.add-friend-plus {
	cursor: pointer;
}

</style>

@stop


@section('content')

{{ Form::open(['url' => '#', 'id' => 'friend-search-form']) }}
<div class="input-group input-group-lg">
	<input type="text" class="form-control input-lg search-term" placeholder="Search for more friends">
	<span class="input-group-btn search">
		<button type="submit" id="friend-search-btn" class="btn btn-primary"><i class="fa fa-search"></i></button>
	</span>
</div>
<!-- /.input-group -->
{{ Form::close() }}

<div class="search-results-container hidden col-lg-4 col-md-4 col-sm-4 col-xs-4">
	<h3>Search Results</h3>
	<ul class="list-group">
		<!-- search result items -->
	</ul>
</div>

<div class="friend-list-container col-lg-12 col-md-12 col-sm-12 col-xs-12">
<ul class="list-group">

@foreach($friends as $friend)

	<li class="list-group-item">{{ $friend->displayname }}</li>

@endforeach

</ul>

@stop


@section('scripts')

<script>

var addFriend = function(target) {
	var id = target.parent().data('user_id');
	var username = "{{ Auth::user()->username }}";
	$.ajax({
		url: "{{ URL::to('" + username + "/friends/add/" + id + "') }}",
		type: 'GET',
		data: { friend_id: id }
	}).done(function(data) {
		console.log(data);
	});
};

$('#friend-search-form').submit(function() {
	var search_terms = $('.search-term').val();
	$.ajax({
		url: "{{ URL::to('friends/search') }}",
		data: { term: search_terms },
		type: 'GET'
	}).done(function(data) {
		$('.search-results-container').html('');
		for(var i in data)
		{
			$('.search-results-container').append(data[i].element);
		}
		$('.search-results-container').removeClass('hidden');
		$('.add-friend-plus').on('click', function() { addFriend($(this)) });
	});

	return false;
});

</script>

@stop
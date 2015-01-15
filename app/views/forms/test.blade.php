@extends('_layouts.master')

@section('content')

<form method="post" action="#" id="my-form">

<input type="text" name="test" value="test">

</form>

<button type="button" class="btn btn-default" id="submit-form">Submit form</button>

@stop

@section('scripts')

<script>

$('#submit-form').click(function() {
	$('#my-form').submit();
});

</script>

@stop
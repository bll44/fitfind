@extends('_layouts.email.master')

@section('title')

<h2>Password Reset</h2>

@stop

@section('body')
<p>Hi {{ $user->displayname }},</p>
<p>Please use the below link to reset your FitFind account password. Remember a strong password is recommended for all of your accounts!</p>
<p>
{{ link_to_route('forgot_password.show_reset_password',
	URL::route('forgot_password.show_reset_password',
	[$user->id, $resetCode]), [$user->id, $resetCode]) }}
</p>

Reset Code: <b>{{ $resetCode }}</b>


@stop
@extends('_layouts.master')

@section('styles')

<style>

.address-warning {
	padding-bottom: 5px;
}
</style>

@stop

@section('content')

<h1 class="page-title">My Account</h1>
<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Contact Information</h3>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="alert alert-success hidden ci-alert" id="contact-update-success-msg">
					<p>Contact information updated successfully.</p>
				</div>
				<div class="alert alert-danger hidden ci-alert" id="contact-update-fail-msg">
					<p>Contact information update failed.</p>
				</div>
				{{ Form::open(['url' => '#', 'role' => 'form', 'id' => 'contact-info-form']) }}

				<div class="form-group">
					{{ Form::label('name', 'Name') }}
					{{ Form::text('name', Auth::user()->displayname, ['class' => 'form-control',
												  'placeholder' => 'Name',
												  'id' => 'name-field']) }}
				</div>
				<!-- /.form-group -->

				<div class="form-group">
					{{ Form::label('email', 'Email address') }}
					{{ Form::email('email', Auth::user()->email, ['class' => 'form-control',
												  'placeholder' => 'Email address',
												  'id' => 'email-field']) }}
				</div>
				<!-- /.form-group -->

				<div class="form-group">
					{{ Form::label('phone', '10-digit Mobile phone number') }}
					{{ Form::text('phone', Auth::user()->phone, ['class' => 'form-control',
												  'placeholder' => 'Mobile phone number',
												  'id' => 'phone-field',
												  'autocomplete' => 'off']) }}
				</div>
				<!-- /.form-group -->
				<button type="submit" class="btn btn-primary">Save Contact Information</button>
				{{ Form::close() }}
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.column -->

	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Address Information</h3>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="alert alert-success hidden ai-alert" id="address-update-success-msg">
					<p>Address information updated successfully.</p>
				</div>
				<div class="alert alert-danger hidden ai-alert" id="address-update-fail-msg">
					<p>Address information update failed.</p>
				</div>
				{{ Form::open(['url' => '#', 'role' => 'form', 'id' => 'address-info-form']) }}

				<div class="form-group">
					{{ Form::label('street', 'Street') }}
					{{ Form::text('street', Auth::user()->street, ['class' => 'form-control',
												  'placeholder' => 'Street name',
												  'id' => 'street-field']) }}
				</div>
				<!-- /.form-group -->

				<div class="form-group">
					<label for="unit">Unit # <small>(ie. Apt. 2, 3rd Floor, Suite 501, etc.)</label>
					{{ Form::text('unit', Auth::user()->unit, ['class' => 'form-control',
												  'placeholder' => 'Unit',
												  'id' => 'unit-field']) }}
				</div>
				<!-- /.form-group -->

				<div class="form-group">
					{{ Form::label('zip', 'Zip Code') }}
					{{ Form::text('zip', Auth::user()->zip, ['class' => 'form-control',
												  'placeholder' => 'Zip code',
												  'id' => 'zip-field',
												  'autocomplete' => 'off']) }}
				</div>
				<!-- /.form-group -->

				<div class="form-group">
					{{ Form::label('city', 'City') }}
					{{ Form::text('city', Auth::user()->city, ['class' => 'form-control',
												  'placeholder' => 'City',
												  'id' => 'city-field',
												  'autocomplete' => 'off']) }}
				</div>
				<!-- /.form-group -->
				<div class="form-group">
					{{ Form::label('state', 'State') }}
					{{ Form::text('state', Auth::user()->state, ['class' => 'form-control',
												  'placeholder' => 'State',
												  'id' => 'state-field',
												  'autocomplete' => 'off']) }}
				</div>
				<!-- /.form-group -->
				<button type="submit" class="btn btn-primary">Save Address Information</button>
				{{ Form::close() }}
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.column -->
</div>
<!-- /.row 0 -->

<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Password Options</h3>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">

				<div class="alert alert-success hidden pwd-alert" id="pwd-change-success-msg">
					<p>Password changed successfully.</p>
				</div>
				<div class="alert alert-danger hidden pwd-alert" id="pwd-change-fail-msg">
					<p>Password change failed.</p>
				</div>

				<div class="change-password-form-container">
					{{ Form::open(['url' => '#', 'id' => 'change-password-form', 'role' => 'form']) }}

						<div class="form-group">
							{{ Form::label('old_password', 'Old password') }}
							{{ Form::password('old_password', ['class' => 'form-control',
															   'placeholder' => 'Old password',
															   'id' => 'old_password-field']) }}
						</div>
						<!-- /.form-group -->

						<div class="form-group">
							{{ Form::label('new_password', 'New password') }}
							{{ Form::password('new_password', ['class' => 'form-control',
															   'placeholder' => 'New password',
															   'id' => 'new_password-field']) }}
						</div>
						<!-- /.form-group -->

						<div class="form-group">
							{{ Form::label('new_password_confirmation', 'Type new password again') }}
							{{ Form::password('new_password_confirmation', ['class' => 'form-control',
																			'placeholder' => 'Confirm new password',
																			'id' => 'password_confirmation-field']) }}
						</div>
						<!-- /.form-group -->
						<button type="submit" class="btn btn-primary">Change Password</button>
					{{ Form::close() }}
					<!-- /.change-password-form -->
				</div>
				<!-- /.change-password-form-container -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.column -->
	<div class="col-lg-6">
		<p>{{ link_to_route('account.remove', 'I want to delete my account forever.', [Auth::user()->id], ['id' => 'destroy-account-lnk', 'class' => 'text-danger']) }}</p>
	</div><!-- /.column -->
</div>
<!-- /.row 1 -->

@stop

@section('scripts')

<script>

function hideAlerts(class_name)
{
	$('.' + class_name).each(function() {
		if($(this).is(':visible'))
		{
			$(this).addClass('hidden');
		}
	});
}

$('#change-password-form').submit(function() {
	hideAlerts('pwd-alert');

	var oldPassword = $('#old_password-field').val(),
		newPassword = $('#new_password-field').val(),
		newPasswordConfirmed = $('#password_confirmation-field').val();

	$.ajax({
		url: "{{ URL::route('account.change_password', [Auth::user()->id]) }}",
		type: 'POST',
		data: { old_password: oldPassword, new_password: newPassword, new_password_confirmation: newPasswordConfirmed },
		dataType: 'json'
	}).done(function(data) {
		if(data.status === 'success')
		{
			$('.change-password-form-container').addClass('hidden');
			$('#pwd-change-success-msg').removeClass('hidden');
		}
		else if(data.status === 'fail')
		{
			$('#pwd-change-fail-msg').removeClass('hidden');
		}
		$('#change-password-form input').each(function() {
			$(this).val('');
		});
	});

	return false;
});

$('#contact-info-form').submit(function() {
	hideAlerts('ci-alert');

	var emailAddress = $('#email-field').val(),
		phoneNumber = $('#phone-field').val(),
		name = $('#name-field').val();

	if(phoneNumber.length > 10 || phoneNumber.length < 10)
	{
		$('#contact-update-fail-msg').removeClass('hidden');
		return false;
	}

	$.ajax({
		url: "{{ URL::route('account.save_contact_info', [Auth::user()->id]) }}",
		type: 'POST',
		data: { name: name, email: emailAddress, phone: phoneNumber },
		dataType: 'json'
	}).done(function(data) {
		// console.log(data);
		// console.log(data.status);
		// console.log(data.message);
		if(data.status === 'success')
		{
			$('#contact-update-success-msg').removeClass('hidden');
		}
		else if(data.status === 'fail')
		{
			$('#contact-update-fail-msg').removeClass('hidden');
		}
	});

	return false;
});

$('#address-info-form').submit(function() {
	hideAlerts('ai-alert');

	var street = $('#street-field').val(),
		unit = $('#unit-field').val(),
		city = $('#city-field').val(),
		state = $('#state-field').val(),
		zip = $('#zip-field').val();

	$.ajax({
		url: "{{ URL::route('account.save_address_info', [Auth::user()->id]) }}",
		type: 'POST',
		data: { street: street, unit: unit, city: city, state: state, zip: zip },
		dataType: 'json'
	}).done(function(data) {
		if(data.status === 'success')
		{
			$('#address-update-success-msg').removeClass('hidden');
		}
		else
		{
			console.log('fail');
		}
	});

	return false;
});

</script>

@stop
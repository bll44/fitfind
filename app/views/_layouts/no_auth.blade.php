<!DOCTYPE html>
<html lang="en">

@include('_layouts/_partials/header_no_auth')

<body>

@yield('styles')

	<div class="container">

		@yield('content')

	</div>

@include('_layouts/_partials/footer')

@yield('scripts')

</body>
</html>
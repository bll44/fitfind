<!DOCTYPE html>
<html lang="en">

@include('_layouts/_partials/header')

<body>

@yield('styles')

@include('_layouts/_navs/main')

	<div class="container">

		@yield('content')

	</div>

@include('_layouts/_partials/footer')

@yield('scripts')
</body>
</html>
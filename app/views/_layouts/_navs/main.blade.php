<div class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">

			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#master-nav">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<a class="navbar-brand" href="{{ URL::to('dashboard') }}" style="color: #009933">FitFind</a>

		</div>
		<div class="navbar-collapse collapse" id="master-nav">

			<ul class="nav navbar-nav">

				<li id="navtab-dashboard">{{ link_to_route('dashboard.index', 'Dashboard') }}</li>
				<li class="dropdown" id="navtab-events">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						Events <span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li>{{ link_to_route('event.create', 'Create an Event') }}</li>
						<li>{{ link_to_route('event.index', 'Browse All Events') }}</li>
					</ul>
				</li>
				<li class="dropdown" id="navtab-events">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						Teams <span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li>{{ link_to_route('teams.index', 'My Teams') }}</li>
						<li>{{ link_to_route('teams.create', 'Create A Team') }}</li>
						<li>{{ link_to_route('teams.list', 'Browse All Teams') }}</li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						Hi, {{ Auth::user()->displayname }} <span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li>{{ link_to_route('notifications.settings.show', 'Notification Settings', [Auth::user()->id]) }}</li>
						<li>{{ link_to_route('account.show', 'Account Settings', [Auth::user()->id]) }}</li>
						<li>{{ link_to('auth/logout', 'Log out') }}</li>
					</ul>
				</li>
			</ul>
		</div><!-- / navbar-collapse -->
	</div><!-- / container -->
</div><!-- / navbar -->
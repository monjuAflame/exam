<div class="wrapper" id='app'>
	<nav class="main-header navbar navbar-expand navbar-white navbar-light">

		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
			</li>
			@hasanyrole('admin')
			<li class="nav-item d-none d-sm-inline-block">
				<a href="/" class="nav-link">Home</a>
			</li>
			@endhasanyrole			
			@hasanyrole('student')
			<li class="nav-item d-none d-sm-inline-block">
				<a href="{{ route('student.show', auth()->user()->studentProfile->student_id) }}" class="nav-link">Profile</a>
			</li>
			@endhasanyrole			
			{{--      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>--}}
		</ul>

		@hasanyrole('admin')
		<form method="POST" action="{{ route('student.search') }}" class="form-inline ml-3">
			@csrf
			<div class="input-group input-group-sm">
				<input name="student_id" class="form-control form-control-navbar" type="search"
					placeholder="Search Student by ID" aria-label="Search" required>
				<div class="input-group-append">
					<button class="btn btn-navbar" type="submit">
						<i class="fas fa-search"></i>
					</button>
				</div>
			</div>
		</form>
		@endhasanyrole

		{{-- Right Sidebar --}}
		@guest
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="{{ route('login') }}">Login</a>
				</li>
			</ul>
		@endguest

	</nav>
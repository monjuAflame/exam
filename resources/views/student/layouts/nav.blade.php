<div class="navbar-holder bg-white shadow-sm">
    <div class="col-11 mx-auto">
        <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="/">{{ env('APP_NAME') }}</a>
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('student.profile') }}">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/">Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('student.exam') }}">Exams</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('student.result') }}">Results</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/">All Courses</a>
            </li>
            </ul>

            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
                <a
                class="nav-link dropdown-toggle"
                data-toggle="dropdown"
                href="/"
                role="button"
                aria-haspopup="true"
                aria-expanded="false"
                >
                <img src="/images/user.png" class="user-icon rounded-circle border" alt="Profile"/><span class="ml-2">John Doe</span></a
                >
                <div class="dropdown-menu border-0 shadow-sm profile-dropdown">
                <a class="dropdown-item" href="/">My Dashboard</a>
                <a class="dropdown-item" href="/">My Profile</a>
                <a class="dropdown-item" href="/">System Preferences</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">Log Out</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
                <div id="darkmode" class="custom-control custom-switch">
                    <input
                    type="checkbox"
                    class="custom-control-input"
                    id="customSwitch1"
                    />
                    <label class="custom-control-label" for="customSwitch1">
                    <i class="bi bi-moon"></i>
                    </label>
                </div>
                </div>
            </li>
            </ul>
        </div>
        </nav>
    </div>
</div>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    
    <a href="/" class="brand-link" style="border-bottom: none;">
      <img src="{{ asset(env('LOGO_NAME', 'logo.svg')) }}" alt="logo" class="brand-image" style="">
    </a>
   
    <div class="sidebar">
      	<div class="user-panel mt-20 pb-3 mb-3 d-flex">
			{{--<div class="image">
				<img src="{{ asset('images/user.jpg') }}" class="img-circle elevation-2" alt="User Image">
			</div>
			@hasanyrole('admin')
			<div class="info">
				<a href="#" class="d-block">{{ Auth::user()->first_name}}</a>
			</div>
			@endhasanyrole
  --}}
    	</div>

		<nav class="mt-2">

			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

				@hasanyrole('admin')
				<li class="nav-item">
					<a href="{{ route('home') }}" class="nav-link {{ $route_name == 'home' ? 'active' : '' }}">
					<i class="nav-icon fas fa-tachometer-alt indigo"></i>
					<p>
						Dashboard
					</p>
					</a>
				</li>
				@endhasanyrole

				@unlessrole('student')				
				<li class="nav-item {{ preg_match('/^student\.(create|list|due)$/', $route_name) ? 'menu-open' : '' }}">
					<a href="#" class="nav-link {{ preg_match('/^student\.(create|list)$/', $route_name) ? 'active' : '' }}">
						<i class="nav-icon fas fa-user-graduate {{ preg_match('/^student\.(create|list)$/', $route_name) ? 'white' : 'teal' }}"></i>
						<p>
						Students
						<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ route('student.create') }}" class="nav-link {{ preg_match('/^student\.create$/', $route_name) ? 'active' : '' }}">
								<i class="fa fa-edit nav-icon"></i>
								<p>Sudent Registration</p>
							</a>
						</li>

						@hasanyrole('admin')
						<li class="nav-item">
							<a href="{{ route('student.list') }}" class="nav-link {{ preg_match('/^student\.list$/', $route_name) ? 'active' : '' }}">
								<i class="fas fa-list nav-icon"></i>
								<p>Student List</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('student.due') }}" class="nav-link {{ preg_match('/^student\.due$/', $route_name) ? 'active' : '' }}">
								<i class="fas fa-bell nav-icon"></i>
								<p>Student Due List</p>
							</a>
						</li>
						@endhasanyrole

						
					</ul>
				</li>
				@endunlessrole

				@hasanyrole('admin')
				<li class="nav-item {{ preg_match('/^category\.(create|list)$/', $route_name) ? 'menu-open' : '' }}">
					<a href="{{ route('category.create') }}" class="nav-link {{ preg_match('/^category\.(create|list|edit)$/', $route_name) ? 'active' : '' }}">
						<i class="nav-icon fas fa-tags {{ preg_match('/^category\.(create|list|edit)$/', $route_name) ? 'white' : 'teal' }}"></i>
						<p>Course Category</p>
					</a>
					{{--<ul class="nav nav-treeview">
						<li class="nav-item">
						<a href="{{ route('category.create') }}" class="nav-link {{ preg_match('/^category\.create$/', $route_name) ? 'active' : '' }}">
							<i class="fa fa-edit nav-icon"></i>
							<p>Create Category</p>
						</a>
						</li>
						<li class="nav-item">
						<a href="{{ route('category.list') }}" class="nav-link {{ preg_match('/^category\.list$/', $route_name) ? 'active' : '' }}">
							<i class="fa fa-edit nav-icon"></i>
							<p>Categories List</p>
						</a>
						</li>
						
						
					</ul>--}}
				</li>

				<li class="nav-item {{ preg_match('/^course\.(create|list)$/', $route_name) ? 'menu-open' : '' }}">

					<a href="{{ route('course.create') }}" class="nav-link {{ preg_match('/^course\.(create|list|edit)$/', $route_name) ? 'active' : '' }}">
						<i class="nav-icon fas fa-book-open {{ preg_match('/^course\.(create|list|edit)$/', $route_name) ? 'white' : 'teal' }}"></i>
						<p>
						Course
						{{--<i class="fas fa-angle-left right"></i>--}}
						</p>
					</a>
					{{--<ul class="nav nav-treeview">
						<li class="nav-item">
						<a href="{{ route('course.create') }}" class="nav-link {{ preg_match('/^course\.create$/', $route_name) ? 'active' : '' }}">
							<i class="fa fa-edit nav-icon"></i>
							<p>Create Course</p>
						</a>
						</li>
						<li class="nav-item">
						<a href="{{ route('course.list') }}" class="nav-link {{ preg_match('/^course\.list$/', $route_name) ? 'active' : '' }}">
							<i class="fa fa-edit nav-icon"></i>
							<p>Course List</p>
						</a>
						</li>
						
						
					</ul>--}}
				</li>

				<li class="nav-item {{ preg_match('/^batch\.(create|list)$/', $route_name) ? 'menu-open' : '' }}">
					
					<a href="{{ route('batch.create') }}" class="nav-link {{ preg_match('/^batch\.(create|list|edit)$/', $route_name) ? 'active' : '' }}">
						<i class="nav-icon fas fa-users {{ preg_match('/^batch\.(create|list|edit)$/', $route_name) ? 'white' : 'teal' }}"></i>
						<p>Batch</p>
					</a>
{{--					
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ route('batch.create') }}" class="nav-link {{ preg_match('/^batch\.create$/', $route_name) ? 'active' : '' }}">
								<i class="fa fa-edit nav-icon"></i>
								<p>Create Batch</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('batch.list') }}" class="nav-link {{ preg_match('/^batch\.list$/', $route_name) ? 'active' : '' }}">
								<i class="fa fa-edit nav-icon"></i>
								<p>Batch List</p>
							</a>
						</li>
						
						
					</ul>
--}}
				</li>
				<li class="nav-item {{ preg_match('/^sheet\.(create|list)$/', $route_name) ? 'menu-open' : '' }}">
					
					<a href="{{ route('sheet.create') }}" class="nav-link {{ preg_match('/^sheet\.(create|list|edit)$/', $route_name) ? 'active' : '' }}">
						<i class="nav-icon fas fa-file-alt {{ preg_match('/^sheet\.(create|list|edit)$/', $route_name) ? 'white' : 'teal' }}"></i>
						<p>Sheet</p>
					</a>
					{{--<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ route('sheet.create') }}" class="nav-link {{ preg_match('/^sheet\.create$/', $route_name) ? 'active' : '' }}">
								<i class="fa fa-edit nav-icon"></i>
								<p>Create Sheet</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('sheet.list') }}" class="nav-link {{ preg_match('/^sheet\.list$/', $route_name) ? 'active' : '' }}">
								<i class="fa fa-edit nav-icon"></i>
								<p>Sheet List</p>
							</a>
						</li>
						
						
					</ul>--}}
				</li>
				
				<li class="nav-item {{ preg_match('/^exam\.(create|list)$/', $route_name) ? 'menu-open' : '' }}">
					<a href="{{ route('exam.index') }}" class="nav-link {{ preg_match('/^exam\.(create|list)$/', $route_name) ? 'active' : '' }}">
						<i class="nav-icon fas fa-stream {{ preg_match('/^exam\.(create|list)$/', $route_name) ? 'white' : 'teal' }}"></i>
						<p>
						Exams
						{{--<i class="fas fa-angle-left right"></i>--}}
						</p>
					</a>
					{{--<ul class="nav nav-treeview">
						<li class="nav-item">
						<a href="{{ route('exam.create') }}" class="nav-link {{ preg_match('/^exam\.index$/', $route_name) ? 'active' : '' }}">
							<i class="fa fa-edit nav-icon"></i>
							<p>Create Exam</p>
						</a>
						</li>
						<li class="nav-item">
						<a href="{{ route('question.list') }}" class="nav-link {{ preg_match('/^question\.list$/', $route_name) ? 'active' : '' }}">
							<i class="fa fa-edit nav-icon"></i>
							<p>Question List</p>
						</a>
						</li>
						
						
					</ul>--}}
				</li>

				<li class="nav-item {{ preg_match('/^payment\.(create|list)$/', $route_name) ? 'menu-open' : '' }}">
					<a href="{{ route('payment.list') }}" class="nav-link {{ preg_match('/^payment\.(create|list)$/', $route_name) ? 'active' : '' }}">
					<i class="nav-icon fas fas fa-dollar-sign {{ preg_match('/^payment\.(create|list)$/', $route_name) ? 'white' : 'teal' }}"></i>
						<p>Payments</p>
					</a>
{{--
					<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="{{ route('payment.create') }}" class="nav-link {{ 'payment.create' == $route_name ? 'active' : '' }}">
						<i class="fa fa-edit nav-icon"></i>
						<p>Create Payment</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('payment.list') }}" class="nav-link {{ 'payment.list' == $route_name ? 'active' : '' }}">
						<i class="fa fa-edit nav-icon"></i>
						<p>Payment List</p>
						</a>
					</li>
					
					
					</ul>
--}}
				</li>

				<li class="nav-item {{ preg_match('/^sms\.(create|list)$/', $route_name) ? 'menu-open' : '' }}">
					<a href="#" class="nav-link {{ preg_match('/^sms\.(create|list)$/', $route_name) ? 'active' : '' }}">
					<i class="nav-icon fa fa-envelope {{ preg_match('/^sms\.(create|list)$/', $route_name) ? 'white' : 'teal' }}"></i>
					<p>
						SMS Management
						<i class="fas fa-angle-left right"></i>
					</p>
					</a>
					<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="{{ route('sms.create') }}" class="nav-link {{ 'sms.create' == $route_name ? 'active' : '' }}">
						<i class="fa fa-edit nav-icon"></i>
						<p>Send Message</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('sms.list') }}" class="nav-link {{ 'sms.list' == $route_name ? 'active' : '' }}">
						<i class="fa fa-edit nav-icon"></i>
						<p>Message List</p>
						</a>
					</li>
					
					
					</ul>
				</li>	
				<li class="nav-item {{ preg_match('/^expense\.(create|list|edit)$/', $route_name) ? 'menu-open' : '' }}">
					<a href="{{ route('expense.create') }}" class="nav-link {{ preg_match('/^expense\.(create|list|edit)$/', $route_name) ? 'active' : '' }}">
						<i class="nav-icon fa fa-plus-circle {{ preg_match('/^expense\.(create|list|edit)$/', $route_name) ? 'white' : 'teal' }}"></i>
						<p>Expense</p>
					</a>	
				</li>
				<li class="nav-item {{ preg_match('/^report\.(incomeStatement)$/', $route_name) ? 'menu-open' : '' }}">
					<a href="{{ route('report.incomeStatement') }}" class="nav-link {{ preg_match('/^report\.(incomeStatement)$/', $route_name) ? 'active' : '' }}">
						<i class="nav-icon fa fa-clipboard {{ preg_match('/^report\.(incomeStatement)$/', $route_name) ? 'white' : 'teal' }}"></i>
						<p>Income Statement</p>
					</a>	
				</li>	
				@endhasanyrole          
				
				@auth
				<li class="nav-item">
					<a class="nav-link" href="{{ route('logout') }}"
							onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">
						<i class="nav-icon fas fa-power-off red"></i>
						<p>
						{{ __('Logout') }}
						</p>
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
				</li>
				@endauth

			</ul>
    	</nav>  
  	</div>
</aside>
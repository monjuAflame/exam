<!DOCTYPE html>
<html lang="en">

@include('student.layouts.header')



  <body>
    <div id="mainBody">
		@include('student.layouts.nav');
		<section class="main-section profile-section my-3">
			<div class="container-fluid">
				<div class="col-12 mx-auto">
					<div class="row">
						@yield('content')
					</div>
				</div>
			</div>
		</section>

	</div>

	@include('student.layouts.scripts')

    @yield('js')

</body>
</html>
<!DOCTYPE html>
<html lang="en">

@include('exam.layouts.header')



<body data-layout="fluid" data-sidebar-behavior="sticky" data-sidebar-position="left" data-theme="default">
  	<div class="wrapper">  

		@include('exam.layouts.sidebar')
		
		<div class="main">
			@include('exam.layouts.nav')

			@yield('content')

		    @include('exam.layouts.footer')
		</div>
	</div>

	@include('exam.layouts.scripts')

    @yield('js')

</body>


</html>
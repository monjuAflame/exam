<footer class="main-footer">
	<div class="float-right d-none d-sm-block">
	  Powered by <b> <a href="https://ogrosoft.com"> Ogro Soft</b></a>
	</div>
	<strong>Copyright &copy; <span class="footer-year"></span> <a href="/">{{ env('APP_NAME') }}</a></strong> All rights reserved.
	</footer>
    {{--<aside class="control-sidebar control-sidebar-dark">
  	</aside>--}}
</div>

<script>
	var date = (new Date()).getFullYear();
	document.querySelector('.footer-year').innerText = `2020-${date}`;
</script>
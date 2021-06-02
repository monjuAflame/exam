<footer class="footer">
    <div class="container-fluid">
        <div class="row text-muted">
            <div class="col-6 text-left">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a class="text-muted" href="#">Privacy</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="#">Terms of Service</a>
                    </li>
                </ul>
            </div>
            <div class="col-6 text-right">
                <p class="mb-0">
                    &copy; <span class="footer-year">2020-2021</span><a class="text-muted" href="#">{{ env('APP_NAME') }}</a>
                </p>
            </div>
        </div>
    </div>
</footer>
<script>
	var date = (new Date()).getFullYear();
	document.querySelector('.footer-year').innerText = `2020-${date}`;
</script>

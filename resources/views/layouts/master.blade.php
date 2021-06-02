<!DOCTYPE html>
<html lang="en">

@include('layouts.header')


<body class="hold-transition sidebar-mini layout-fixed">
  
    @include('layouts.nav')

    @include('layouts.sidebar')
    
    <div class="content-wrapper">
        <section class="content-header">
          <div class="container-fluid">
              <div class="row">
                @yield('page-title')
              </div>
          </div>
        </section>
        <section class="content">
          <div class="container-fluid">
            <div class="row">
                @yield('content')   
            </div>
          </div>
        </section>
    </div>

    @include('layouts.footer')

    




    @include('layouts.scripts')

    @yield('js')
</body>

</html>
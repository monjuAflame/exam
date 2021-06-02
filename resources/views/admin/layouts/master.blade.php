<!DOCTYPE html>
<html lang="en">

@include('admin.layouts.header')



<body class="hold-transition sidebar-mini layout-fixed">
  
    @include('admin.layouts.nav')

    @include('admin.layouts.sidebar')
    
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
            <div class="row justify-content-center">
                @yield('content')   
            </div>
          </div>
        </section>
    </div>

    @include('admin.layouts.footer')
    @include('admin.layouts.scripts')

    @yield('js')
</body>

</html>
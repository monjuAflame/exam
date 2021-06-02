<head>
    <meta charset="utf-8">

    <title>CMS | Coaching Management System</title>

    @yield('og-meta')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    
    <!-- Favicon and Touch Icons-->
    
    {{-- Bootstrap --}}
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css"
    integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g=="
    crossorigin="anonymous" />--}}

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}" />
    <link rel="stylesheet" href="{{ mix('/css/adminlte.css') }}" />
    <link rel="stylesheet" href="{{ mix('/css/custom.css') }}" />
    <link rel="stylesheet" href="{{ mix('/css/main.css') }}"/>

</head>

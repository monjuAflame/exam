<head>
    <meta charset="utf-8">

    <title>{{ env('APP_NAME') }}</title>

    @yield('og-meta')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    
    <!-- Favicon and Touch Icons-->

    
    {{-- Include bootstrap css --}}
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}" />
    
    {{-- Include adminlte css --}}
    <link rel="stylesheet" href="{{ mix('/css/adminlte.css') }}" />

    {{-- Include custom writter css --}}
    <link rel="stylesheet" href="{{ mix('/css/custom.css') }}" />
    <link rel="stylesheet" href="{{ mix('/css/main.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
    @yield('css')

    
    


</head>


    
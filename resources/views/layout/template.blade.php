<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('bootstrap/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <script src="{{asset('bootstrap/js/bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{asset('bootstrap/js/jQuery.js')}}" type="text/javascript"></script>
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="app">
    @include('partials.navBar')

    @yield('content')

    @include('partials.footer')
</div>

<!-- Scripts -->
<script src="{{asset('bootstrap/js/bootstrap.js')}}" type="text/javascript"></script>
<script src="{{asset('bootstrap/js/jQuery.js')}}" type="text/javascript"></script>
<script src="{{asset('bootstrap/js/app.js')}}" type="text/javascript"></script>
</body>
</html>
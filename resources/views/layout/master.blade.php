<!DOCTYPE html>
<html lang="en" ng-app="angularApp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="token" id="token" value="{{ csrf_field() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
</head>

{{--    <link rel="stylesheet" href={{asset('css/bootstrap-theme.min.css')}}>--}}

<link rel="stylesheet" href={{asset('css/vendor.css')}}>
<link rel="stylesheet" href={{asset('css/app.css')}}>



<title>Snooker-Clubs DMS</title>

</head>
<body>

@include('layout.top-menu')

<div class="container" id="app">

    @if(session('success') || session('error') || $errors->any())
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            @include('alert._success')
            @include('alert._error')
        </div>
    @endif

    @yield('content')


</div>

@include('footer');

<script src={{asset('js/manifest.js')}}></script>
<script src={{asset('js/vendor.js')}}></script>
<script src={{asset('js/app.js')}}></script>

<script src={{asset('angularApp/app.js')}}></script>
<script src={{asset('angularApp/controllers/playerCtrl.js')}}></script>
<script src={{asset('angularApp/controllers/gameCtrl.js')}}></script>

@yield('script')


</body>
</html>

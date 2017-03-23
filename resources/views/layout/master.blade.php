<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('favicon.ico') }}"></head>

{{--    <link rel="stylesheet" href={{asset('css/bootstrap-theme.min.css')}}>--}}
    <link rel="stylesheet" href={{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}>
    <link rel="stylesheet" href={{asset('bower_components/font-awesome/css/font-awesome.min.css')}}>
    <link rel="stylesheet" href={{asset('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}>
    <link rel="stylesheet" href={{asset('bower_components/flatpickr/dist/flatpickr.css')}}>

    <link rel="stylesheet" href={{asset('css/style.css')}}>


    <title>Snooker-Clubs DMS</title>

</head>
<body>

@include('layout.top-menu');

<div class="container">

    @yield('content')

</div>


<script src={{asset('bower_components/jquery/dist/jquery.min.js')}}></script>
<script src={{asset('bower_components/moment/min/moment.min.js')}}></script>
<script src={{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}></script>
<script src={{asset('bower_components/angular/angular.min.js')}}></script>
<script src={{asset('bower_components/angular-animate/angular-animate.min.js')}}></script>
<script src={{asset('bower_components/vue/dist/vue.js')}}></script>
{{--<script src={{asset('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}></script>--}}
<script src={{asset('bower_components/flatpickr/dist/flatpickr.js')}}></script>


<script src={{asset('js/site.js')}}></script>

{{--<script src={{asset('angularApp/app.js')}}></script>--}}
{{--<script src={{asset('angularApp/controllers/orderCtrl.js')}}></script>--}}
{{--<script src={{asset('angularApp/controllers/todoCtrl.js')}}></script>--}}

@yield('script')

   


</body>
</html>

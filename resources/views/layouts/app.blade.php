<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>{{ config('app.name', 'Ez-Ronda2 UKM') }}</title>
</head>
        <body>
        @include('inc.navbar')
        @yield('zon')
        <div class="container">
            @include('inc.messages')
        @yield('content')
        @yield('patrol')
        </div>
        </body>
    </div>

    <!-- Scripts -->
    <script src="{{asset('js/app.js')}}"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
</body>
</html>

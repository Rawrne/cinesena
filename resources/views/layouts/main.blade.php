<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/vendor/lineawesome/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}?v={{ env('CSS_VERSION', 1) }}">
    <title>{{env('APP_NAME')}} - @yield('title')</title>
    @yield('head')
</head>
<body class="bg-dark text-light">
    <header>
        @include('templates.nav')
        @yield('header')
    </header>
    <main class="main">
        @includeWhen(Route::is('home'), 'templates.banner')
        <div class="content">
            @yield('main')
        </div>       
    </main>
    <footer>
        @include('templates.footer')
        @yield('footer')
    </footer>
    <script src="{{asset('/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    @yield('scripts')
</body>
</html>
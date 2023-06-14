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
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                @yield('modal')
            </form>
          </div>
        </div>
      </div>
      
    <main class="main">
        <div class="content">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-3">
                        <div class="d-flex mb-3">
                            <a href="{{route('home')}}" class="btn btn-secondary"><i class="las la-undo"></i> Volver a <b>{{env('APP_NAME')}}</b></a>
                        </div>
                        <header>
                            @include('templates.panel.nav')
                            @yield('header')
                        </header>
                    </div>
                    <div class="col-md">
                        @yield('main')
                    </div>
                </div>
            </div>
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
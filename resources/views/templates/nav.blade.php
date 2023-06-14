<nav class="navbar fixed-top navbar-expand-lg bg-primary shadow p-0 py-1">
    <div class="container">
      <a class="navbar-brand p-0" href="{{ route('home') }}">
        <img class="logo" src="{{asset('/img/logo-secondary.webp')}}" alt="{{ env('APP_NAME') }}" height="48">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            @if (Route::is('home'))
              <a class="nav-link active" aria-current="page" href="#">Portada</a>
            @else
              <a class="nav-link" href="{{route('home')}}">Portada</a>
            @endif
          </li>
          <li class="nav-item">
            @if (Route::is('films'))
              <a class="nav-link active" aria-current="page" href="#">Películas</a>
            @else
              <a class="nav-link" href="{{route('films')}}">Películas</a>
            @endif
          </li>
        </ul>
        <div class="d-flex gap-2">
          @guest
            <a href="{{ route('register') }}" class="btn btn-light align-middle"><i class="lab la-wpforms la-2x align-middle"></i> <span class="align-middle">Registrarse</span></a>
            <a href="{{ route('login') }}" class="btn btn-dark align-middle"><i class="las la-sign-in-alt la-2x align-middle"></i> <span class="align-middle">Iniciar sesión</span></a> 
          @endguest
          @auth
            <a href="{{ route('profile') }}" class="btn btn-light align-middle"><i class="las la-user-circle la-2x align-middle"></i> <span class="align-middle">Mi perfil</span></a>
            @if (Auth::user()->type == 1)
              <a href="{{ route('panel') }}" class="btn btn-secondary align-middle"><i class="las la-th-list la-2x align-middle"></i> <span class="align-middle">Panel</span></a>
            @endif
            <a href="{{ route('logout') }}" class="btn btn-dark align-middle"><i class="las la-sign-out-alt la-2x align-middle"></i> <span      class="align-middle">Salir</span></a> 
          @endauth      
        </div>
      </div>
    </div>
  </nav>
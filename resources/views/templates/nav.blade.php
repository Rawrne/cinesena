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
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Reparto
            </a>
            <ul class="dropdown-menu">
              <li>
                @if (Route::is('directors'))
                <a class="nav-link active" aria-current="page" href="#">Directores</a>
              @else
                <a class="nav-link" href="{{route('directors')}}">Directores</a>
              @endif
              </li>
              <li>
                @if (Route::is('writers'))
                <a class="nav-link active" aria-current="page" href="#">Guionistas</a>
              @else
                <a class="nav-link" href="{{route('writers')}}">Guionistas</a>
              @endif
              </li>
              <li>
                @if (Route::is('actors'))
                <a class="nav-link active" aria-current="page" href="#">Actores</a>
              @else
                <a class="nav-link" href="{{route('actors')}}">Actores</a>
              @endif
              </li>
            </ul>
          </li>
          <li class="nav-item">
            @if (Route::is('reviews'))
            <a class="nav-link active" aria-current="page" href="#">Reseñas</a>
          @else
            <a class="nav-link" href="{{route('reviews')}}">Reseñas</a>
          @endif
          </li>
        </ul>

        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Escribe aquí..." aria-label="Search">
          <button class="btn btn-outline-light" type="submit"><i class="las la-search la-2x align-middle"></i> <span class="align-middle"></span></button>
        </form>

        <div class="d-flex gap-2">
          @guest
            <a href="{{ route('register') }}" class="btn btn-light align-middle"><i class="lab la-wpforms la-2x align-middle"></i> <span class="align-middle">Registrarse</span></a>
            <a href="{{ route('login') }}" class="btn btn-dark align-middle"><i class="las la-sign-in-alt la-2x align-middle"></i> <span class="align-middle">Iniciar sesión</span></a> 
          @endguest
          @auth
            <a href="{{ route('profile') }}" class="btn btn-light align-middle"><i class="las la-user-circle la-2x align-middle"></i> <span class="align-middle">Mi perfil</span></a>
            <a href="{{ route('logout') }}" class="btn btn-dark align-middle"><i class="las la-sign-out-alt la-2x align-middle"></i> <span      class="align-middle">Salir</span></a> 
          @endauth      
        </div>
      </div>
    </div>
  </nav>
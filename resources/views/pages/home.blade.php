@extends('layouts.main')

@section('title', 'Home')

@section('main') 
        @guest
            <div class="container py-3">
                <h1 class="text-center mb-3">Entra y comparte tu pasión por el cine</h1>
                <div class="text-center mb-5">
                    <a href="{{ route('register') }}" class="btn btn-success align-middle">
                        <i class="lab la-wpforms la-2x align-middle"></i>
                        <span class="align-middle">Empieza ya. Es gratis</span>
                    </a>
                </div>
                <div class="row text-center">
                    <div class="col">
                    <a href="{{ route("films.all") }}" class="text-light" style="text-decoration: none;">
                        <h2>Catálogo</h2>
                        <p>Consulta tus películas favoritas</p>
                    </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('register') }}" class="text-light" style="text-decoration: none;">
                            <h2>Reseñas</h2>
                            <p>Escribe tus ideas</p> 
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('register') }}" class="text-light" style="text-decoration: none;">
                            <h2>Comentarios</h2>
                            <p>Participa en las discusiones y debates</p>
                        </a>
                    </div>
                </div>
            </div>                          
        @endguest
        @auth
        <div class="container py-3">
            <h1 class="text-center mb-5">Bienvenido a cineseña</h1>
            <div class="row text-center">
                <div class="col">
                <a href="{{ route("films.all") }}" class="text-light" style="text-decoration: none;">
                    <h2>Catálogo</h2>
                    <p>Consulta tus películas favoritas</p>
                </a>
                </div>
                <div class="col">
                    <a href="{{ route('films') }}" class="text-light" style="text-decoration: none;">
                        <h2>Reseñas</h2>
                        <p>Escribe tus ideas</p> 
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('profile') }}" class="text-light" style="text-decoration: none;">
                        <h2>Perfil</h2>
                        <p>Consulta tu perfil</p>
                    </a>
                </div>
            </div>
        </div> 
    @endauth   
@endsection
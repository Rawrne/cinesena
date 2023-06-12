@extends('layouts.main')

@section('title', 'Mi perfil')

@section('main')
    <div class="container py-3">
        {{-- @dump(Auth::user()) --}}
        <form method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <div class="col-3">
                    @php($img = Auth::user()->image ?? "../not_found.jpeg")
                    <img class="w-100" src="{{ asset("/img/profiles/{$img}")}}" alt="">
                </div>
                <div class="col">
                    <input type="text" name="name" required value="{{ Auth::user()->name }}" placeholder="Tu nombre" class="form-control mb-2" style="max-width: 360px;">
                    <input type="text" name="email" value="{{ Auth::user()->email }}" placeholder="Tu email" disabled class="form-control mb-3" style="max-width: 360px;">
                    <textarea name="bio" class="form-control" placeholder="Cuenta algo sobre ti" rows="8">{{ Auth::user()->bio }}</textarea>         
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success btn-lg"><i class="las la-2x la-save align-middle"></i> <span class="align-middle">Guardar cambios</span></button>
            </div>
        </form>     
        <h3 class="mt-4">Reseñas ({{ $reviews->count() }})</h3>
        <hr>
        {{-- Lobby de reseñas --}}
        @include('templates.lobbies.reviews', [
            'reviews' => $reviews
        ])
       
    </div>
    
@endsection
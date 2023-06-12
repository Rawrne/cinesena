@extends('layouts.main')

@section('title', 'Películas')

@section('main')
    <style>
        
    </style>
    <div class="container pb-3 pt-5">
        {{-- @dd($films) --}}
       
        <div class="row mb-5">
            <div class="col-3">
                @php($img = $film->image ?? "../not_found.jpeg")
                <img class="w-100" src="{{ asset("/img/films/{$img}")}}" alt="">
            </div>
            <div class="col">
                <h1>{{ $film->name }}</h1>
                <h2 class="fs-4 fw-light">{{ $film->description }}</h2>
                <div class="table-responsive mt-4">
                    <table class="table table-dark table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th class="px-4" style="width: 1px; white-space: nowrap;">País de origen</th>
                                <td class="px-4">{{ $film->country }}</td>
                            </tr>
                            <tr>
                                <th class="px-4" style="width: 1px; white-space: nowrap;">Año</th>
                                <td class="px-4">{{ $film->year }}</td>
                            </tr>
                            <tr>
                                <th class="px-4" style="width: 1px; white-space: nowrap;">Duración</th>
                                <td class="px-4">{{ $film->length }}'</td>
                            </tr>
                            <tr>
                                <th class="px-4" style="width: 1px; white-space: nowrap;">Género</th>
                                <td class="px-4">{{ $film->genre->implode('name',', ') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <h3 class="mt-3">Dirección ({{ $film->directors->count() }})</h3>
        <hr>
        {{-- Lobby de directores --}}
        @include('templates.lobbies.directors', [
            'directors' => $film->directors
        ])
        
        <h3 class="mt-3">Guión ({{ $film->writers->count() }})</h3>
        <hr>
        {{-- Lobby de guionistas --}}
        @include('templates.lobbies.writers', [
            'writers' => $film->writers
        ])

        <h3 class="mt-3">Reparto ({{ $film->actors->count() }})</h3>
        <hr>
        {{-- Lobby de actores --}}
        @include('templates.lobbies.actors', [
            'actors' => $film->actors
        ])
        
        <div class="d-flex justify-content-between">
            <h3 class="mt-3">Reseñas ({{ $film->reviews->count() }})</h3>
            @auth
            <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <form method="post">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-dark fs-3 text-center w-100" id="exampleModalToggleLabel">{{ $film->name }}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2">
                                @php($img = $film->image ?? "../not_found.jpeg")
                                <img class="img-fluid" src="{{ asset("/img/films/{$img}")}}" alt="{{$film->name}}">
                            </div>
                            <div class="col-md">
                                
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $film->id }}">
                                    <div class="rating d-flex gap-3 mb-3">
                                        <i class="las la-2x la-star text-warning"></i> <input type="number" value="0" required name="rating" min="0" max="5" step=".5" class="form-control w-auto shadow-sm">
                                    </div>
                                    <textarea name="review" class="form-control" required placeholder="Escribe tu opinión..." rows="8"></textarea>         
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" value="Publicar" class="btn btn-success">
                    </div>
                  </div>
                </div>
                </form>
              </div>
                <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button"><i class="las la-2x la-pen-alt align-middle"></i> <span class="align-middle">Escribir reseña</span></button>
            @endauth
        </div>
        <hr>
        {{-- Lobby de reseñas --}}
        <div id="reviews"></div>
        @include('templates.lobbies.reviews', [
            'reviews' => $film->reviews
        ])
    </div>
    
@endsection
@section('scripts')
    <script>
        
    </script>
@endsection
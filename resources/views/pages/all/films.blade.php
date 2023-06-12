@extends('layouts.main')

@section('title', 'Películas')

@section('main')
    <style>
        
    </style>
    <div class="container py-3">
        {{-- @dd($films) --}}
        @include('templates.lobbies.allfilms', [
            'title' => 'Todas las películas',
            'films' => $films,
        ])
    </div>
    
@endsection
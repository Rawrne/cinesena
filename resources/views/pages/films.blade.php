@extends('layouts.main')

@section('title', 'Películas')

@section('main')
    <style>
        
    </style>
    <div class="container py-3">
        {{-- @dd($films) --}}
        @include('templates.lobbies.films', [
            'title' => 'Películas del siglo XX',
            'films' => $lobby1,
        ])

        @include('templates.lobbies.films', [
            'title' => 'Películas del siglo XXI',
            'films' => $lobby2,
        ])

        @include('templates.lobbies.films', [
            'title' => 'Películas de más 2h',
            'films' => $lobby3,
        ])
    </div>
    
@endsection
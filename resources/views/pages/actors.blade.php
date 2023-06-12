@extends('layouts.main')

@section('title', 'Actores')

@section('main')
    <div class="container py-3">
        @dump($actors)
    </div>
    
@endsection
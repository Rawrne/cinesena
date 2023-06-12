@extends('layouts.main')

@section('title', 'Directores')

@section('main')
    <div class="container py-3">
        @dump($directors)
    </div>
    
@endsection
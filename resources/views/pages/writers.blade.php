@extends('layouts.main')

@section('title', 'Guionistas')

@section('main')
    <div class="container py-3">
        @dump($writers)
    </div>
    
@endsection
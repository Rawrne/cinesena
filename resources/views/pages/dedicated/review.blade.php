@extends('layouts.main')

@section('title', 'Review')

@section('main')
    <div class="container py-3">
       @dump($film)
       @dump($review)
    </div>
    
@endsection
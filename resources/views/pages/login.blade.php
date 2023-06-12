@extends('layouts.secondary')

@section('title', 'Login')

@section('main')
    <div class="container py-3">
        <div class="card p-5 mb-5 mx-5 bg-offdark text-light">
            <a class="link-secondary" href="{{ route('home') }}"><i class="las la-arrow-left"></i> Volver al inicio</a>
            <h1 class="text-center fs-3 mb-0">Iniciar sesión en {{ env('APP_NAME') }}</h1>
            <hr>
            <form method="POST">
                @csrf
                @if ($errors->has('email'))
                    <div class="mb-3 alert alert-danger">
                        <p class="mb-0">{{ $errors->first('email') }}</p>
                    </div>
                @endif
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text text-light">No lo compartiremos con nadie más.</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input name="password" type="password" class="form-control" id="password">
                </div>
                <div class="mb-4 form-check">
                    <input name="check" type="checkbox" class="form-check-input" id="check">
                    <label class="form-check-label" for="check">Recordar inicio de sesión</label>
                </div>
                <div class="d-flex gap-3 align-items-center justify-content-center">
                    <button type="submit" class="btn btn-primary btn-lg"><i class="las la-paper-plane"></i> Iniciar sesión</button>
                    <span>o</span>
                    <a class="btn btn-success btn-lg" href="{{ route('register') }}"><i class="lab la-wpforms"></i> Registrarse</a>
                </div>
            </form>
    </div>
    
@endsection
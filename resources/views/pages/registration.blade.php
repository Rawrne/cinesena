@extends('layouts.secondary')

@section('title', 'Registro')

@section('main')
    <div class="container py-3">
        <div class="card p-5 mb-5 mx-5 bg-offdark text-light">
            <a class="link-secondary" href="{{ route('home') }}"><i class="las la-arrow-left"></i> Volver al inicio</a>
            <h1 class="text-center fs-3 mb-0">Únete a {{ env('APP_NAME') }}</h1>
            <hr>
            <form method="POST">
                @csrf
                @if ($errors->has('email'))
                    <div class="mb-3 alert alert-danger">
                        <p class="mb-0">{{ $errors->first('email') }}</p>
                    </div>
                @endif
                @if ($errors->has('user'))
                    <div class="mb-3 alert alert-danger">
                        <p class="mb-0">{{ $errors->first('user') }}</p>
                    </div>
                @endif
                @if ($errors->has('password'))
                    <div class="mb-3 alert alert-danger">
                        <p class="mb-0">{{ $errors->first('password') }}</p>
                    </div>
                @endif
                @if ($errors->has('check'))
                    <div class="mb-3 alert alert-danger">
                        <p class="mb-0">{{ $errors->first('check') }}</p>
                    </div>
                @endif
                @if ($errors->has('required'))
                    <div class="mb-3 alert alert-danger">
                        <p class="mb-0">{{ $errors->first('required') }}</p>
                    </div>
                @endif
                <div class="row mb-3">
                    <div class="col-md">
                        <div class="mb-3">
                            <label for="user" class="form-label">Nombre de usuario</label>
                            <input name="user" value="{{ old('user') }}" placeholder="Escribe tu alias" type="text" class="form-control" id="user" aria-describedby="userHelp" required>
                            <div id="userHelp" class="form-text text-light">Elígelo bien.</div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" value="{{ old('email') }}" placeholder="Escribe tu dirección de correo" type="email" class="form-control" id="email" aria-describedby="emailHelp" required>
                            <div id="emailHelp" class="form-text text-light">No lo compartiremos con nadie más.</div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md">
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input name="password[]" value="{{ old('password')[0] ?? null }}" placeholder="Introduce tu contraseña" type="password" class="form-control" id="password" aria-describedby="passwordHelp" required>
                            <div id="passwordHelp" class="form-text text-light">Que sea segura.</div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input name="password[]" value="{{ old('password')[1] ?? null }}" placeholder="Repite tu contraseña" type="password" class="form-control" id="password" required>
                        </div>
                    </div>
                </div>             
                <div class="mb-4 form-check">
                    <input name="check" type="checkbox" class="form-check-input" id="check">
                    <label class="form-check-label" for="check">Acepto los <a href="#" class="link-light">Términos y Condiciones</a></label>
                </div>
                <div class="d-flex gap-3 align-items-center justify-content-center">
                    <button type="submit" class="btn btn-success btn-lg"><i class="lab la-wpforms"></i> Registrarse</button>
                    <span>o</span>
                    <a class="btn btn-primary btn-lg" href="{{ route('login') }}"><i class="las la-paper-plane"></i> Iniciar sesión</a>
                </div>
            </form>
    </div>
    
@endsection
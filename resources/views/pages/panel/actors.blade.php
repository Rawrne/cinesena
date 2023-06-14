@extends('layouts.panel')

@section('title', 'Panel - Actores')

@section('modal')
    <div class="modal-header text-dark">
        <h1 class="modal-title fs-5" id="modalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body text-dark">
        <div class="row">
            <div class="col-md mb-3">
                <div>
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="Nombre del Actor" required>
                </div>
            </div>
            <div class="col-md mb-3">
                <div>
                    <label for="country" class="form-label">País de origen:</label>
                    <select class="form-select" id="country" name="country" autocomplete="off" required>
                        @foreach ($countries as $country)
                            <option value="{{$country->id}}">{{$country->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md mb-3">
                <div>
                    <label for="birthdate" class="form-label">Fecha de nacimiento:</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" autocomplete="off" placeholder="Fecha de nacimiento">
                </div>
            </div>
            <div class="col-md mb-3">
                <div>
                    <label for="image" class="form-label">Imagen:</label>
                    <input type="file" class="form-control" id="image" name="image" autocomplete="off" placeholder="Imagen">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md mb-3">
                <div>
                    <label for="description" class="form-label">Descripción:</label>
                    <textarea class="form-control" id="description" name="description" autocomplete="off" placeholder="La descripción del Actor..." rows="4"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer text-dark">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal"><i class="las la-times"></i> Cancelar</button>
        <button type="submit" class="btn btn-primary"><i class="las la-plus"></i> Añadir</button>
    </div>
@endsection

@section('main')
    <div>
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal"><i class="las la-plus"></i> <b>Nuevo</b></button>
        </div>
        <div class="table-responsive">
            <table class="table table-dark table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Nombre</th>
                        <th>Origen</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($actors as $actor)
                        <tr>
                            <td class="text-center">{{$actor->id}}</td>
                            <td>{{$actor->name}}</td>
                            <td>{{$actor->country ?? "Sin Origen"}}</td>
                            <td class="text-center">
                                <form method="post" onsubmit="return confirm('¿Estás seguro de que quieres eliminar a {{$actor->name}}?');">
                                    @csrf
                                    @method("DELETE")
                                    <input type="hidden" name="id" value="{{$actor->id}}">
                                    <button type="submit" class="btn btn-link link-danger p-0"><i class="las la-2x la-times link-danger text-decoration-none"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No hay Actores...</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
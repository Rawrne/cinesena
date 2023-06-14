@extends('layouts.panel')

@section('title', 'Panel - Películas')

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
                    <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="Nombre de la película" required>
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
                    <label for="length" class="form-label">Longitud:</label>
                    <input type="number" min="0" class="form-control" id="length" name="length" autocomplete="off" placeholder="Duración (minutos)">
                </div>
            </div>
            <div class="col-md mb-3">
                <div>
                    <label for="year" class="form-label">Año:</label>
                    <input type="number" class="form-control" id="year" name="year" autocomplete="off" placeholder="Año de lanzamiento">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md mb-3">
                <div>
                    <label for="image" class="form-label">Imagen:</label>
                    <input type="file" class="form-control" id="image" name="image" autocomplete="off" placeholder="Imagen">
                </div>
            </div>
            <div class="col-md mb-3">
                <div>
                    <label for="description" class="form-label">Descripción:</label>
                    <textarea class="form-control" id="description" name="description" autocomplete="off" placeholder="La descripción de la película..." rows="4"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md mb-3">
                <div>
                    <label for="directors" class="form-label">Director(es):</label>
                    <select class="form-select" id="directors" name="directors[]" autocomplete="off" required multiple>
                        @foreach ($directors as $director)
                            <option value="{{$director->id}}">{{$director->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md mb-3">
                <div>
                    <label for="writers" class="form-label">Escritor(es):</label>
                    <select class="form-select" id="writers" name="writers[]" autocomplete="off" required multiple>
                        @foreach ($writers as $writer)
                            <option value="{{$writer->id}}">{{$writer->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md mb-3">
                <div>
                    <label for="actors" class="form-label">Actor(es):</label>
                    <select class="form-select" id="actors" name="actors[]" autocomplete="off" required multiple>
                        @foreach ($actors as $actor)
                            <option value="{{$actor->id}}">{{$actor->name}}</option>
                        @endforeach
                    </select>
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
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal"><i class="las la-plus"></i> <b>Nueva</b></button>
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
                    @forelse ($films as $film)
                        <tr>
                            <td class="text-center">{{$film->id}}</td>
                            <td>{{$film->name}}</td>
                            <td>{{$film->country}}</td>
                            <td class="text-center">
                                <form method="post" onsubmit="return confirm('¿Estás seguro de que quieres eliminar {{$film->name}}?');">
                                    @csrf
                                    @method("DELETE")
                                    <input type="hidden" name="id" value="{{$film->id}}">
                                    <button type="submit" class="btn btn-link link-danger p-0"><i class="las la-2x la-times link-danger text-decoration-none"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No hay películas...</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
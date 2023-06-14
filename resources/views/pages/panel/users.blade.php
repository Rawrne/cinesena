@extends('layouts.panel')

@section('title', 'Panel - Usuarios')

@section('modal')
    <div class="modal-header text-dark">
        <h1 class="modal-title fs-5" id="modalLabel">Nuevo Usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body text-dark">
        <div class="row">
            <div class="col-md mb-3">
                <div>
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="Nombre de Usuario" required>
                </div>
            </div>
            <div class="col-md mb-3">
                <div>
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" autocomplete="off" placeholder="Email" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md mb-3">
                <div>
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" autocomplete="off" placeholder="Contraseña de Usuario" aria-describedby="passwordHelp">
                    <div id="passwordHelp" class="form-text">Si no se rellena, <strong>12345</strong>.</div>
                </div>
            </div>
            <div class="col-md mb-3">
                <div>
                    <label for="type" class="form-label">Tipo:</label>
                    <select class="form-select" id="type" name="type" autocomplete="off" required>
                        <option value="0" selected>Usuario Estándar</option>
                        <option value="1">Administrador</option>
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
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal"><i class="las la-plus"></i> <b>Nuevo</b></button>
        </div>
        <div class="table-responsive">
            <table class="table table-dark table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="text-center">{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td class="text-center">
                                <form method="post" onsubmit="return confirm('¿Estás seguro de que quieres eliminar a {{$user->name}}?');">
                                    @csrf
                                    @method("DELETE")
                                    <input type="hidden" name="id" value="{{$user->id}}">
                                    <button type="submit" class="btn btn-link link-danger p-0"><i class="las la-2x la-times link-danger text-decoration-none"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No hay usuarios a parte de tí...</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
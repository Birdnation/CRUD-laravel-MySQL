@extends('layouts.app')

@section('content')
@if(Session::has('usuarioB'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Usuario borrado con exito.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

@if(Session::has('userEdit'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Usuario Editado con exito.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

<div class="container">
    <div class="row">
        <div class = "col-md-12 col-md-offset-2">
            <div class="card">
                <div class="card-header">
                    <h3 style="text-align:center">Lista de Usuarios</h3>
                    
                    <nav class="navbar navbar-light float-right">
                        <form class="form-inline">
                            <input name="buscarporrut" class="form-control mr-sm-1" type="search" placeholder="Buscar por rut" aria-label="Search">
                            <input name="buscarporemail" class="form-control mr-sm-1" type="search" placeholder="Buscar por email" aria-label="Search">
                            <button class="btn btn-success my-2 mr-sm-2" type="submit">  Buscar  </button>
                            <button class="btn btn-success my-2 mr-sm-4" type="submit">  Limpiar  </button>
                            <a href="{{route('usuario.create')}}" class="btn my-2 mr-sm-2 btn-primary" style="float:right">Crear un nuevo usuario</a>
                        </form>
                    </nav>
                </div>
                

                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Rut</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                @if ($user->borrar == null)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->rut}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>
                                    @foreach($user->rols as $rol)
                                        <div>
                                            <div>{{$rol->rol}}</div>
                                        </div>
                                    @endforeach
                                    </td>
                                    <td>
                                        <a href="usuario/{{$user->id}}"class='btn btn-primary mr-sm-2'>Ver</a>
                                        <a href="usuario/edit/{{$user->id}}"class='btn btn-warning mr-sm-2'>Editar</a>

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#{{$user->id}}">
                                            Eliminar
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade " id="{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">¿Estas seguro que deseas eliminar a {{$user->email}}?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                <a href="usuario/destroy/{{$user->id}}"class='btn btn-danger mr-sm-2'>Eliminar</a>
                                            </div>
                                            </div>
                                        </div>
                                        </div>

                                        
                                                                
                                        
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                    <ul class="pagination">
                    {{$users->links()}}

                    </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
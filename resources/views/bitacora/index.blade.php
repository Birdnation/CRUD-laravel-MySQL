@extends('layouts.app')

@section('content')
@php ($motivo = 'no') @endphp

@if(Session::has('eliminado'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Bitacora Eliminada con exito!.</strong>
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
                    <h3 style="text-align:center">Lista de Bitacoras</h3>
                    <nav class="navbar navbar-light float-right">
                        <form class="form-inline">
                            <input name="buscarportitulo" class="form-control mr-sm-1" type="search" placeholder="Buscar por titulo" aria-label="Search">
                            <button class="btn btn-success my-2 mr-sm-2" type="submit">  Buscar  </button>
                            <button class="btn btn-success my-2 mr-sm-4" type="submit">  Limpiar  </button>
                            <a href="{{route('bitacora.create')}}" class="btn my-2 mr-sm-2 btn-primary" style="float:right">Crear una nueva bitacora</a>
                        </form>
                    </nav>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Alumnos Asignados</th>
                            <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bitacoras as $bitacora)
                                @if (!$bitacora->cerrar)
                                    <tr>
                                        <td>{{$bitacora->id}}</td>
                                        <td>{{$bitacora->titulo}}</td>
                                        <td>
                                        @foreach($bitacora->users as $user)
                                            <div>
                                            @foreach($user->rols as $rol)
                                                @if ($rol->rol == 'ESTUDIANTE TESISTA')
                                                    <div>Rut: {{$user->rut}} Nombre: {{$user->name}} </div>
                                                @endif
                                            @endforeach
                                            </div>
                                        @endforeach
                                        </td>
                                        <td>
                                            <a href="bitacora/{{$bitacora->id}}"class='btn btn-primary'>Ver</a>
                                            <a href="bitacora/edit/{{$bitacora->id}}"class='btn btn-warning'>Editar</a>

                                            <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#{{$bitacora->id}}">
                                            Eliminar
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade " id="{{$bitacora->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">¿Estas seguro que deseas eliminar la bitacora con el titulo de {{$bitacora->titulo}}?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="bitacora/destroy/{{$bitacora->id}}">
                                            <div class="modal-body">
                                                Selecciona el motivo de la eliminacion:
                                                <div class="form-check">
                                                    <input name="deletebitacora" class="form-check-input" type="radio" value="No_continuidad" id="defaultCheck5">
                                                    <label class="form-check-label" for="defaultCheck5">No Continuidad del trabajo</label>
                                                </div>
                                                <div class="form-check">
                                                    <input name="deletebitacora" class="form-check-input" type="radio" value="Aprobacion" id="defaultCheck5">
                                                    <label class="form-check-label" for="defaultCheck5">Termino del trabajo</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    
                                            </div>
                                            <input name="id" class="form-check-input" type="hidden" value="{{$bitacora->id}}">
                                        </form>
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
                    {{$bitacoras->links()}}

                    </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
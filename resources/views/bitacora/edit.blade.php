@extends('layouts.app')

@section('content')

@if(Session::has('nonTitulo'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> El titulo es un campo requerido.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

@if(Session::has('profeEliminado'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Exito!</strong> El profesor fue desvinculado de la biblioteca con exito.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

@if(Session::has('sinProfe'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> No es posible dejar una bitacora sin profesor guia.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

@if(Session::has('sinReemplazo'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> No es posible dejar una bitacora sin profesor guia.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

@if(Session::has('reemplazo'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Exito!</strong> Se realizo el reemplazo de profesor guia con exito.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

@if(Session::has('agregado'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>El profesor fue agregado con exito!</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

@if(Session::has('exceso'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

@if(Session::has('repetido'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong>Has seleccionado eliminar y agregar al mismo profesor
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

@if(Session::has('yasel'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong>El profesor ya se encuentra agregado a la bitacora
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

@if(Session::has('alumnoEliminado'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Alumno desvinculado de la bitacora con exito!</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

@if(Session::has('sinAlumnos'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong>No es posible dejar una bitacora sin alumnos.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

@if(Session::has('excede'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong>No es posible asignar otro profesor a esta bitacora
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif


@php ($a = 0)@endphp

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edicion de Bitacora</div>

                <div class="panel-body">
                    <form action="/bitacora/editar">
                    <input class="form-control" name="id" type="hidden" value="{{$id}}">

                        <div class="form-group">
                            <label for="titulo" class="col-md-6 control-label" >Titulo</label>

                            <div class="col-md-12">
                                <input id="titulo" type="titulo" class="form-control" name="titulo" type="text" placeholder="Este campo es obligatorio..." value="{{$bitacoras->find($id)->titulo}}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <label for="rutsA" class="col-md-8 control-label">Seleccione los RUTs de los alumnos participantes:</label>
                        <p>
                            <a class="btn btn-warning" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Eliminar algun estudiante...</a>
                            <button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Modificar Profesor Guia...</button>
                        </p>
                        <div class="row">
                            <div class="col">
                                <div class="collapse multi-collapse" id="multiCollapseExample1">
                                    <div class="card card-body">
                                        <label for="titulo" class="col-md-12 control-label">Seleccione los RUTs de los alumnos a eliminar de la bitacora:</label>
                                        @foreach ($bitacoras->find($id)->users as $user)
                                            @foreach ($user->rols as $roles)
                                                @if ($roles->rol == "ESTUDIANTE TESISTA")
                                                <div class="form-check">
                                                    <input name="deleteAlumno" class="form-check-input" type="radio" value="{{$user->id}}" id="defaultCheck5">
                                                    <label class="form-check-label" for="defaultCheck5">RUT: {{$user->rut}}</label>
                                                    @php ($a++) @endphp
                                                </div>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                                <div class="collapse multi-collapse" id="multiCollapseExample2">
                                    <div class="card card-body">
                                        <label for="titulo" class="col-md-12 control-label">Seleccione el rut del profesor que desea quitar de la bitacora:</label>
                                        @foreach ($bitacoras->find($id)->users as $user)
                                            @foreach ($user->rols as $roles)
                                                @if ($roles->rol == "PROFESOR GUIA")
                                                <div class="form-check">
                                                    <input name="deleteProfe" class="form-check-input" type="radio" value="{{$user->id}}" id="defaultCheck5">
                                                    <label class="form-check-label" for="defaultCheck5">RUT: {{$user->rut}}</label>
                                                </div>
                                                @endif
                                            @endforeach
                                        @endforeach
                                        <label for="titulo" class="col-md-12 control-label">seleccione el rut del profesor que desea agregar a la bitacora:</label>
                                        <select class="form-control" name="profesor1">
                                            <option name="">Seleccione...</option>
                                                @foreach(App\User::all() as $user)
                                                    @foreach($user->rols as $rol)
                                                        @if ($rol->rol == 'PROFESOR GUIA')
                                                            <option name="addProfe">{{$user->rut}}</option>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Ingresar
                                </button>
                                <a href="/bitacora" type="submit" class="btn btn-warning" name="botonvolver" value="Check">Volver</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
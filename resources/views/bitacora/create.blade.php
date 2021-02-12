@extends('layouts.app')

@section('content')

@if(Session::has('sinAlumnos'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>ERROR!</strong> No puedes crear una Bitacora sin Alumnos.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

@if(Session::has('sinProfesor'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>ERROR!</strong> No puedes crear una Bitacora sin Profesor Guia.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        @if ($error == "The titulo format is invalid.")
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Formato de titulo.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    @endforeach
@endif

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Creacion de Bitacora</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('bitacora.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="titulo" class="col-md-6 control-label" >Titulo</label>

                            <div class="col-md-12">
                                <input id="titulo" type="titulo" class="form-control" name="titulo" type="text" required autofocus>
                                    <span class="help-block"></span>
                            </div>
                        </div>
                        <label for="titulo" class="col-md-8 control-label">Seleccione los RUTs de los alumnos participantes:</label>
                        <select class="form-control" name="alumno1">
                            <option name="">Seleccione...</option>
                        @foreach(App\User::all() as $user)
                            @foreach($user->rols as $rol)
                                @if ($rol->rol == 'ESTUDIANTE TESISTA')
                                    <option name="rut_Alumno1">{{$user->rut}}</option>
                                @endif
                            @endforeach
                        @endforeach    
                        </select>

                        <select class="form-control" name="alumno2">
                            <option name="">Seleccione...</option>
                        @foreach(App\User::all() as $user)
                            @foreach($user->rols as $rol)
                                @if ($rol->rol == 'ESTUDIANTE TESISTA')
                                    <option name="rut_Alumno2">{{$user->rut}}</option>
                                @endif
                            @endforeach
                        @endforeach    
                        </select>

                        <select class="form-control" name="alumno3">
                            <option name="">Seleccione...</option>
                        @foreach(App\User::all() as $user)
                            @foreach($user->rols as $rol)
                                @if ($rol->rol == 'ESTUDIANTE TESISTA')
                                    <option name="rut_Alumno3">{{$user->rut}}</option>
                                @endif
                            @endforeach
                        @endforeach    
                        </select>

                        <select class="form-control" name="alumno4">
                            <option name="">Seleccione...</option>
                        @foreach(App\User::all() as $user)
                            @foreach($user->rols as $rol)
                                @if ($rol->rol == 'ESTUDIANTE TESISTA')
                                    <option name="rut_Alumno4">{{$user->rut}}</option>
                                @endif
                            @endforeach
                        @endforeach    
                        </select>

                        <label for="titulo" class="col-md-8 control-label">Seleccione los RUTs de los Profesores guia participantes:</label>
                        <select class="form-control" name="profesor1">
                            <option name="">Seleccione...</option>
                        @foreach(App\User::all() as $user)
                            @foreach($user->rols as $rol)
                                @if ($rol->rol == 'PROFESOR GUIA')
                                    <option name="rut_Profesor1">{{$user->rut}}</option>
                                @endif
                            @endforeach
                        @endforeach    
                        </select>
                        <select class="form-control" name="profesor2">
                            <option name="">Seleccione...</option>
                        @foreach(App\User::all() as $user)
                            @foreach($user->rols as $rol)
                                @if ($rol->rol == 'PROFESOR GUIA')
                                    <option name="rut_Profesor2">{{$user->rut}}</option>
                                @endif
                            @endforeach
                        @endforeach    
                        </select>



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
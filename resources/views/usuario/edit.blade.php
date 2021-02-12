@extends('layouts.app')

@section('content')
@php ($a = 'nocheck')@endphp
@php ($b = 'nocheck')@endphp 
@php ($c = 'nocheck')@endphp
@php ($d = 'nocheck')@endphp
@php ($e = 'nocheck')@endphp

@if(Session::has('contraseñaD'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Las contraseñas no coinciden!</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

@if(Session::has('errorsinRoles'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>No puedes dejar a un usuario sin roles!</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

@if(Session::has('errorRolEstudiante'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> No es posible asignar a un estudiante mas de un rol.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

@if(Session::has('errorRolSecretaria'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> No es posible asignar a una secretaria mas de un rol
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

@if(Session::has('errorRolTitulacion'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Solo puede existir un Encargado de titulacion.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

@if(Session::has('rutC'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> El Rut ya existe en la base de datos.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        @if ($error == "The name format is invalid.")
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Formato de nombre.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if ($error == "The rut format is invalid.")
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Formato de Rut.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    @endforeach
@endif


<label for="exampleFormControlInput1"> <h1>Editando:</h1></label>
    <form action="usuario/editar">
        <input id="titulo" type="hidden" class="form-control" name="id" type="text" value="{{$id}}">

        <div class="form-group">
            <div class="col-md-12">
                <label for="exampleFormControlInput1">Nombre</label>
                <input class="form-control" type="text" placeholder="Ingrese..." value="{{$users->find($id)->name}}" name="name">
                <label for="exampleFormControlInput1">Rut</label>
                <input class="form-control" type="text" placeholder="Ingrese..." value="{{$users->find($id)->rut}}" name="rut">
                <label for="exampleFormControlInput1">Email</label>
                <input class="form-control" type="text" placeholder="{{$users->find($id)->email}}" readonly>
                <label for="exampleFormControlInput1">Carrera</label>
                <input class="form-control" type="text" placeholder="Ingrese..."  value="{{$users->find($id)->carrera}}" name="carrera">
                
                <div class="form-check">
                    <label for="rol" class="col-md-12 control-label">Seleccione el Rol del usuario:</label>
                    <div class="col-md-6">
                        @foreach ($users->find($id)->rols as $roles)
                            @if ($roles->rol == 'ESTUDIANTE TESISTA')
                                @php ($a = 'check')@endphp    
                            @elseif ($roles->rol == 'PROFESOR GUIA')
                                @php ($b = 'check')@endphp    
                            @elseif ($roles->rol == 'SECRETARIA')
                                @php ($c = 'check')@endphp    
                            @elseif ($roles->rol == 'ENCARGADO DE TITULACION')
                                @php ($d = 'check')@endphp    
                            @elseif ($roles->rol == 'ADMINISTRADOR')
                                @php ($d = 'check')@endphp   
                            @endif
                        @endforeach

                        @if ($a == 'check')
                            <div class="form-check">
                                <input name="rol1" class="form-check-input" type="checkbox" value="ESTUDIANTE TESISTA" id="defaultCheck1" checked>
                                <label class="form-check-label" for="defaultchecked">
                                    ESTUDIANTE TESISTA
                                </label>
                            </div>
                        @else
                            <div class="form-check">
                                <input name="rol1" class="form-check-input" type="checkbox" value="ESTUDIANTE TESISTA" id="defaultCheck1">
                                <label class="form-check-label" for="defaultchecked">
                                    ESTUDIANTE TESISTA
                                </label>
                            </div>
                        @endif

                        @if ($b == 'check')    
                            <div class="form-check">
                                <input name="rol2" class="form-check-input" type="checkbox" value="PROFESOR GUIA" id="defaultCheck2" checked>
                                <label class="form-check-label" for="defaultCheck2">
                                    PROFESOR GUIA
                                </label>
                            </div>
                        @else
                            <div class="form-check">
                                <input name="rol2" class="form-check-input" type="checkbox" value="PROFESOR GUIA" id="defaultCheck2">
                                <label class="form-check-label" for="defaultCheck2">
                                    PROFESOR GUIA
                                </label>
                            </div>
                        @endif

                        @if ($c == 'check')
                            <div class="form-check">
                                <input name="rol3" class="form-check-input" type="checkbox" value="SECRETARIA" id="defaultCheck3" checked>
                                <label class="form-check-label" for="defaultCheck4">
                                    SECRETARIA
                                </label>
                            </div>
                        @else
                            <div class="form-check">
                                <input name="rol3" class="form-check-input" type="checkbox" value="SECRETARIA" id="defaultCheck3">
                                <label class="form-check-label" for="defaultCheck4">
                                    SECRETARIA
                                </label>
                            </div>
                        @endif

                            

                        @if ($d == 'check')    
                            <div class="form-check">
                                <input name="rol4" class="form-check-input" type="checkbox" value="ENCARGADO DE TITULACION" id="defaultCheck4" checked>
                                <label class="form-check-label" for="defaultCheck4">
                                    ENCARGADO DE TITULACION
                                </label>
                            </div>
                        @else
                            <div class="form-check">
                                <input name="rol4" class="form-check-input" type="checkbox" value="ENCARGADO DE TITULACION" id="defaultCheck4">
                                <label class="form-check-label" for="defaultCheck4">
                                    ENCARGADO DE TITULACION
                                </label>
                            </div>
                        @endif
                    </div>
                </div>



            </div>
            <div class="col-md-12">
                
                <span class="help-block"></span>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Actualizar Contraseña</label>
            <input class="form-control" type="password" placeholder="Ingrese nueva contraseña..."  name="password">

            <label for="exampleFormControlInput1">Confirmar Contraseña</label>
            <input class="form-control" type="password" placeholder="Repita la contraseña..."  name="password_confirm">
            
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-warning">
                    Editar
                </button>
                <button type="submit" class="btn btn-warning" name="botonvolver" value= "Check">Volver</button>
            </div>
        </div>
    </form>

@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registro de Usuarios</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}


                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo Electronico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-check">
                            <label for="rol" class="col-md-12 control-label">Seleccione el Rol del usuario:</label>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input name="rol1" class="form-check-input" type="checkbox" value="ESTUDIANTE TESISTA" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        ESTUDIANTE TESISTA
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input name="rol2" class="form-check-input" type="checkbox" value="PROFESOR GUIA" id="defaultCheck2">
                                    <label class="form-check-label" for="defaultCheck2">
                                        PROFESOR GUIA
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input name="rol3" class="form-check-input" type="checkbox" value="SECRETARIA" id="defaultCheck3">
                                    <label class="form-check-label" for="defaultCheck4">
                                        SECRETARIA
                                    </label>
                                </div>

                                

                                
                                @php
                                    $validador = 1;
                                @endphp
                                @foreach (App\User::all() as $user)
                                    @foreach ($user->rols as $rol)
                                        @if ($rol->rol == 'ENCARGADO DE TITULACION')
                                            <div class="form-check">
                                                <input name="rol4" class="form-check-input" type="checkbox" value="ENCARGADO DE TITULACION" id="defaultCheck4" disabled>
                                                <label class="form-check-label" for="defaultCheck4">
                                                    ENCARGADO DE TITULACION
                                                </label>
                                            </div>
                                            
                                                @php
                                                    $validador = 0;
                                                @endphp
                                            @break
                                        @else
                                            @php
                                                $validador = 1;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if ($validador == 0)
                                        @break
                                    @endif
                                @endforeach

                                @if ($validador == 1)
                                <div class="form-check">
                                    <input name="rol4" class="form-check-input" type="checkbox" value="ENCARGADO DE TITULACION" id="defaultCheck4">
                                    <label class="form-check-label" for="defaultCheck4">
                                        ENCARGADO DE TITULACION
                                    </label>
                                </div>
                                @endif


                                @php
                                    $validador = 1;
                                @endphp
                                @foreach (App\User::all() as $user)
                                    @foreach ($user->rols as $rol)
                                        @if ($rol->rol == 'ADMINISTRADOR')
                                            <div class="form-check">
                                                <input name="rol5" class="form-check-input" type="checkbox" value="ADMINISTRADOR" id="defaultCheck5" disabled>
                                                <label class="form-check-label" for="defaultCheck5">
                                                    ADMINISTRADOR
                                                </label>
                                            </div>
                                            
                                                @php
                                                    $validador = 0;
                                                @endphp
                                            @break
                                        @else
                                            @php
                                                $validador = 1;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if ($validador == 0)
                                        @break
                                    @endif
                                @endforeach

                                @if ($validador == 1)
                                <div class="form-check">
                                    <input name="rol5" class="form-check-input" type="checkbox" value="ADMINISTRADOR" id="defaultCheck5">
                                    <label class="form-check-label" for="defaultCheck5">
                                        ADMINISTRADOR
                                    </label>
                                </div>
                                @endif


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

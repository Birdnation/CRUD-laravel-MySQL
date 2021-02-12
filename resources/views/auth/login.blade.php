@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row text-center login-page">
	    <div class="col-md-12 login-form">
	        <form action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}			
	            <div class="row">
                    <div class="col-md-12 login-form-header">
                    </div>
                </div>
                <i class="fa fa-user-circle" aria-hidden="true"></i>   Correo:
                <div class="row">
                    <div class="col-md-12 login-from-row">
                        <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <i class="fa fa-lock" aria-hidden="true"></i>   Contraseña:
                <div class="row">
                    <div class="col-md-12 login-from-row">
                        <input id="password" type="password" class="form-control" placeholder="Contraseña" name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 login-from-row">
                        <button class="btn btn-info">Entrar</button>
                    </div>
                </div>
	        </form>
	    </div>
    </div>
</div>

@endsection

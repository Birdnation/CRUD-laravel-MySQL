@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <a aria-expanded="false"> Bienvenido  {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Estas en el panel principal
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

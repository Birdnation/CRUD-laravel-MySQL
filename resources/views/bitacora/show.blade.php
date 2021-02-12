@extends('layouts.app')

@section('content')
<label for="exampleFormControlInput1"> <h1>Detalles:</h1></label>
<form>
    <div class = "form-group mb-6   ">
        <label for="exampleFormControlInput1">Titulo</label>
        <textarea class="form-control" rows="2" placeholder="{{$bitacoras->find($id)->titulo}}" readonly></textarea>
    </div>
    <div class = "form-group mb-6   ">
        <label for="exampleFormControlInput1">Estudiantes asignados:</label>
        @foreach ($bitacoras->find($id)->users as $user)
            @foreach ($user->rols as $roles)
                @if ($roles->rol == "ESTUDIANTE TESISTA")
                    <input class="form-control" type="text" placeholder="NOMBRE: {{$user->name}} RUT: {{$user->rut}}" readonly>
                @endif
            @endforeach
        @endforeach

        <label for="exampleFormControlInput1">Profesores guias asignados:</label>
        @foreach ($bitacoras->find($id)->users as $user)
            @foreach ($user->rols as $roles)
                @if ($roles->rol == "PROFESOR GUIA")
                    <input class="form-control" type="text" placeholder="NOMBRE: {{$user->name}} RUT: {{$user->rut}}" readonly>
                @endif
            @endforeach
        @endforeach
    </div>
    <a href="/bitacora" type="submit" class="btn btn-warning" name="botonvolver" value="Check">Volver</a>
</form>
    

@endsection
@extends('layouts.app')

@section('content')
<form action="usuario/editar">
    <label for="exampleFormControlInput1"> <h1>Detalles:</h1></label>
    <form class="form-inline">
        <div class="form-group">
            <div class = "form-group mb-2   ">
                <label for="exampleFormControlInput1">Nombre</label>
                <input class="form-control" type="text" placeholder="{{$users->find($id)->name}}" readonly>
                <label for="exampleFormControlInput1">Rut</label>
                <input class="form-control" type="text" placeholder="{{$users->find($id)->rut}}" readonly>

            </div>
        </div>
    </form>
    
    <form class="form-inline">
        <div class="form-group">
            <div class = "form-group mb-2   ">
                <label for="exampleFormControlInput1">Email</label>
                <input class="form-control" type="text" placeholder="{{$users->find($id)->email}}" readonly>
                
                <label for="exampleFormControlInput1">Carrera</label>
                <input class="form-control" type="text" placeholder="{{$users->find($id)->carrera}}" readonly>
            </div>
        </div>
    </form>


    <form class="form-inline">
        <div class="form-group">
            <div class = "form-group mb-2   ">
                <label for="exampleFormControlInput1">Rol</label>
                @foreach ($users->find($id)->rols as $rol)
                    <input class="form-control" type="text" placeholder="{{$rol->rol}}" readonly>
                @endforeach
            </div>
        </div>
    </form>
    <a href="/usuario" type="submit" class="btn btn-warning" name="botonvolver" value="Check">Volver</a>
</form>

@endsection
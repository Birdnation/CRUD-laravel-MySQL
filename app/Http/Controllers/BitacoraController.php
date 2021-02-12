<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bitacora;
use App\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class BitacoraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if ($request->buscarportitulo) {
            $nombre = $request->get('buscarportitulo');
            $bitacoras = Bitacora::where('titulo','like',"%$nombre%")->paginate(5);
            return view('bitacora.index', compact('bitacoras')); 
        }

        if ($request->buscarporrut) {
            $nombre = $request->get('buscarporrut');
            $bitacoras = Bitacora::where('users->rut','like',"%$nombre%")->paginate(5);
            return view('bitacora.index', compact('bitacoras')); 
        }

        $bitacoras = Bitacora::orderBy('id', 'DESC')->where('cerrar', null)->paginate(5);
        return view('bitacora.index', compact('bitacoras'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('bitacora.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validador = $request->validate([
            'titulo' => 'string|regex:/^[ñA-Za-z _]*[ñA-Za-z][ñA-Za-z _]/',
        ])  ;


        if (($request->alumno1 == "Seleccione...") && ($request->alumno2 == "Seleccione...") && ($request->alumno3 == "Seleccione...") && ($request->alumno4 == "Seleccione...")) {
            return redirect()->back()->withInput()->with('sinAlumnos','agregar alumnos');
        }

        if (($request->profesor1 == "Seleccione...") && ($request->profesor2 == "Seleccione...")) {
            return redirect()->back()->withInput()->with('sinProfesor','agregar profesor');
        }

        $bitacora = Bitacora::create(['titulo' => $request->titulo]);
        foreach (User::get() as $ruts){
            if ($ruts->rut == $request->alumno1 || $ruts->rut == $request->alumno2|| $ruts->rut == $request->alumno3 || $ruts->rut == $request->alumno4 || $ruts->rut == $request->profesor1 || $ruts->rut == $request->profesor2){
                    $bitacora->users()->attach($ruts);
            }
        }

        return redirect()->route('bitacora.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bitacoras = Bitacora::orderBy('id', 'DESC')->paginate();
        return view('bitacora.show',compact('id'), compact('bitacoras'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bitacoras = Bitacora::orderBy('id', 'DESC')->paginate();
        return view('bitacora.edit',compact('id'), compact('bitacoras'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $bitacora = Bitacora::find($request->id);
        if ($request->deletebitacora == "No_continuidad") {
            $bitacora->users()->detach();
            $bitacora->cerrar = 'No_Continuidad';
            $bitacora->save();
            return redirect()->back()->with('eliminado','bitacoraEliminada');
        }

        if ($request->deletebitacora == "Aprobacion") {
            $bitacora->users()->detach();
            $bitacora->cerrar = 'Aprobacion';
            $bitacora->save();
            return redirect()->back()->with('eliminado','bitacoraEliminada');
        }
        return redirect()->back();
    }

    public function actualizar(Request $request)
    {
        
        //Validaciones

        if(!$request->titulo){
            return redirect()->back()->withInput()->with('nonTitulo','sin titulo');
        }

        $i = 0;
        $j = 0;
        if($request->deleteProfe){
            $bitacora = Bitacora::find($request->id);
            foreach ($bitacora->users as $user){
                foreach($user->rols as $roles){
                    if ($roles->rol == 'PROFESOR GUIA') {
                        $i++;
                    }
                }
            }

            if ( ($i < 2) && ($request->profesor1 == 'Seleccione...')) {
                return redirect()->back()->withInput()->with('sinProfe','no profe');
            }

            if (($request->profesor1 == 'Seleccione...') && ($i > 1)) {
                $bitacora->users()->detach($request->deleteProfe);
                $bitacora->save();
                return redirect()->back()->withInput()->with('profeEliminado','Eliminado con exito');            
            }
            foreach (User::all() as $user) {
                if ($user->rut == $request->profesor1) {
                    $usuarioid = $user->id;

                }
            }
            $usuario = User::find($usuarioid);
            $usuario2 = User::find($request->deleteProfe);
            if (($request->profesor1 != 'Seleccione...') && ($usuario->rut != $request->profesor1)) {
                $bitacora->users()->attach($usuario);
                $bitacora->save();
                return redirect()->back()->withInput()->with('agregado','profe agregado');
            }

            if ($usuario == $usuario2) {
                return redirect()->back()->withInput()->with('repetido','profe repetido');
            }
    

            if (($usuario->rut == $request->profesor1) && ($usuario == $usuario2)) {
                return redirect()->back()->withInput()->with('repetido','profe repetido');
            }

            foreach ($bitacora->users as $user){
                if ($usuario->id == $user->id){
                    return redirect()->back()->withInput()->with('yasel','profe ya seleccionado');
                }
            }

            $bitacora->users()->detach($request->deleteProfe);
            $bitacora->save();
            $bitacora->users()->attach($usuario);
            $bitacora->save();
            return redirect()->back()->withInput()->with('reemplazo','reemplazo con exito');
        }


        $bitacora = Bitacora::find($request->id);
        foreach ($bitacora->users as $user){
            foreach($user->rols as $roles){
                if ($roles->rol == 'PROFESOR GUIA') {
                    $i++;
                }
            }
        }
        
        if (($request->profesor1 != 'Seleccione...') && ($i < 2)) {

            foreach (User::all() as $user) {
                if ($user->rut == $request->profesor1) {
                    $usuarioid = $user->id;
                }
            }
            $usuario = User::find($usuarioid);;
            $bitacora->users()->attach($usuario);
            $bitacora->save();
            return redirect()->back()->withInput()->with('agregado','profe agregado');
        }
        if (($request->profesor1 != 'Seleccione...') && ($i > 1)) {
            return redirect()->back()->withInput()->with('excede','excede la cantidad maxima de profe');
        }
        if($request->deleteAlumno) {
            foreach ($bitacora->users as $user) {
                foreach ($user->rols as $rol) {
                    if ($rol->rol == 'ESTUDIANTE TESISTA') {
                        $j++;
                    }
                }
            }
            if ($j > 1) {
                $bitacora->users()->detach($request->deleteAlumno);
                $bitacora->save();
                return redirect()->back()->withInput()->with('alumnoEliminado','Alumno Eliminado');
            }else{
                return redirect()->back()->withInput()->with('sinAlumnos','Bitacora sin alumnos');
            }
        }
        if ($request->titulo) {
            return redirect()->route('bitacora.index');
        }
        return redirect()->back()->withInput()->with('exceso','exceso');



/*
        //Validaciones del actualizar!
        if ($request->botonvolver == "Check") {
            return redirect()->route('usuario.index');
        }


        if ($request->password != $request->password_confirm) {
            return redirect()->back()->withInput()->with('contraseñaD','contraseña diferente');
        }

        if (!$request->rol1 && !$request->rol2 && !$request->rol3 && !$request->rol4 && !$request->rol5) {
            return redirect()->back()->withInput()->with('errorsinRoles','sin Roles');
        }

        if ($request->rol1 && $request->rol2 || $request->rol1 && $request->rol3 || $request->rol1 && $request->rol4 || $request->rol1 && $request->rol5) {
            return redirect()->back()->withInput()->with('errorRolEstudiante','estudiante con mas de 1 rol');
        }

        if ($request->rol3 && $request->rol2 || $request->rol3 && $request->rol4 || $request->rol3 && $request->rol5) {
            return redirect()->back()->withInput()->with('errorRolSecretaria','secretaria con mas de 1 rol');
        }

        $editado = User::find($request->id);

        if (($request->rut != null) && ($request->rut != $editado->rut)) {
            foreach (User::get() as $user) {
                if ($user->rut == $request->rut) {
                    return redirect()->back()->with('rutC','El rut ya existe...');
                }
            }
        }

        if ($request->rol4) {
            foreach (User::all() as $todos){
                foreach($todos->rols as $roles){
                    if ($roles->rol == 'ENCARGADO DE TITULACION') {
                        if ($todos != $editado) {
                            return redirect()->back()->withInput()->with('errorRolTitulacion','El encargado de titulacion no puede ser administrador');
                        }
                    }
                }
            }
        }

        if ($request->password != null) {
            $editado->password = bcrypt($request->password);
        }
        $editado->name = $request->name;
        $editado->rut = $request->rut;
        $editado->carrera = $request->carrera;
        $editado->rols()->detach();
        foreach (Rol::get() as $rols){
            if ($request->rol1 == $rols->rol || $request->rol2 == $rols->rol || $request->rol3 == $rols->rol || $request->rol4 == $rols->rol || $request->rol5 == $rols->rol){
                $rols->users()->attach($editado);
            }
        }
        $editado->save();

        return redirect()->route('usuario.index')->with('userEdit','Usuario editado');
*/
    
    }

}

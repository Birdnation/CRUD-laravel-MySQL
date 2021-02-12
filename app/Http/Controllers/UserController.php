<?php

namespace App\Http\Controllers;

use App\User;
use App\Rol;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
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
        if ($request->buscarporrut) {
            $nombre = $request->get('buscarporrut');
            $users = User::where('rut','like',"%$nombre%")->paginate(5);
            return view('usuario.index', compact('users')); 
        }

        if ($request->buscarporemail) {
            $nombre = $request->get('buscarporemail');
            $users = User::where('email','like',"%$nombre%")->paginate(5);
            return view('usuario.index', compact('users')); 
        }
            
        $users = User::orderBy('id', 'DESC')->where('borrar', null)->paginate(4);
        return view('usuario.index', compact('users'));  
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //VALIDACIONES!

        if ($request->password != $request->password_confirmation) {
            return redirect()->route('usuario.create')->withInput()->with('contraseñaD','contraseña diferente');
        }

        foreach (User::get() as $user) {
            if ($user->email == $request->email) {
                return redirect()->route('usuario.create')->with('emailCopiado','El email ya existe...');
            }
        }

        if (!$request->rol1 && !$request->rol2 && !$request->rol3 && !$request->rol4 && !$request->rol5) {
            return redirect()->route('usuario.create')->withInput()->with('errorsinRoles','sin Roles');
        }

        if ($request->rol1 && $request->rol2 || $request->rol1 && $request->rol3 || $request->rol1 && $request->rol4 || $request->rol1 && $request->rol5) {
            return redirect()->route('usuario.create')->withInput()->with('errorRolEstudiante','estudiante con mas de 1 rol');
        }

        if ($request->rol3 && $request->rol2 || $request->rol3 && $request->rol4 || $request->rol3 && $request->rol5) {
            return redirect()->route('usuario.create')->withInput()->with('errorRolSecretaria','secretaria con mas de 1 rol');
        }

        if ($request->rol4 && $request->rol5) {
            return redirect()->route('usuario.create')->withInput()->with('errorRolTitulacion','El encargado de titulacion no puede ser administrador');
        }
        //FIN VALIDACIONES

        
        $usuario = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password)]);
            
            foreach (Rol::get() as $rols){
                if ($request->rol1 == $rols->rol || $request->rol2 == $rols->rol || $request->rol3 == $rols->rol || $request->rol4 == $rols->rol || $request->rol5 == $rols->rol){
                    $rols->users()->attach($usuario);
                }
            }
        return redirect()->route('usuario.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::orderBy('id', 'DESC')->paginate();
        return view('usuario.show', compact('users'), compact('id')) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::orderBy('id', 'DESC')->paginate();
        return view('usuario.edit',compact('id'), compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuarioD =User::find($id);
        $usuarioD->rols()->detach();
        $usuarioD->borrar = 'borrado';
        $usuarioD->save();
        return redirect()->route('usuario.index')->withInput()->with('usuarioB','El usuario a sido borrado');
    }

    public function actualizar(Request $request)
    {

        if ($request->botonvolver == "Check") {
            return redirect()->route('usuario.index');
        }

        $validador = $request->validate([
            'name' => 'string|regex:/^[ñA-Za-z _]*[ñA-Za-z][ñA-Za-z _]$/|nullable',
            'rut' => 'regex:/^(\d{1,3}(?:\.\d{1,3}){2}-[\dkK])$/|nullable',
        ])  ;

        //Validaciones del actualizar!
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
                        if ($todos->id != $editado->id) {
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

        
    }

}

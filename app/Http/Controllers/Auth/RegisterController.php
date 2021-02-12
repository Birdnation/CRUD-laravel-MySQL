<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Rol;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ])  ;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $newUser = User::create([
        'email' => $data['email'],
        'password' => bcrypt($data['password'])]);
        
        foreach (Rol::get() as $rols){
            if ((array_key_exists('rol1', $data))){
                if($data['rol1'] == $rols->rol){
                    $rols->users()->attach($newUser);
                }
                
            }
            if ((array_key_exists('rol2', $data))){
                if($data['rol2'] == $rols->rol){
                    $rols->users()->attach($newUser);
                }
                
            }
            if ((array_key_exists('rol3', $data))){
                if($data['rol3'] == $rols->rol){
                    $rols->users()->attach($newUser);
                }
                
            }
            if ((array_key_exists('rol4', $data))){
                if($data['rol4'] == $rols->rol){
                    $rols->users()->attach($newUser);
                }
                
            }
            if ((array_key_exists('rol5', $data))){
                if($data['rol5'] == $rols->rol){
                    $rols->users()->attach($newUser);
                }
                
            }
        }
        return $newUser;
    }

    public function show($id)
    {

    }
}

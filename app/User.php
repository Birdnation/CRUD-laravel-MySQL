<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'carrera', 'rut', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function bitacoras(){
        return $this->belongsToMany('App\Bitacora')->withTimestamps();
    }

    public function rols(){
        return $this->belongsToMany('App\Rol')->withTimestamps();
    }

    public function hasRole($role){
        if($role){
            if ($this->rols()->where('rol', $role)->first()) {
                return true;
            }
        }
    return false;
    }
}

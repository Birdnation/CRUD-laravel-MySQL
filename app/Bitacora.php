<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $fillable = [
        'titulo', 'cerrar',
    ];

    public function users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}

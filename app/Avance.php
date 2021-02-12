<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avance extends Model
{
    protected $fillable = [
        'nombre', 'texto', 'evidencia', 'bitacora_id', 'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function bitacoras(){
        return $this->belongsToMany(Bitacora::class);
    }
}

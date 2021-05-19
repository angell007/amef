<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parte extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'componente_id',
    ];

    public function getNombreAttribute()
    {
        return $this->attributes['nombre'];
    }

    public function funcion()
    {
        return $this->hasOne(Funcion::class);
    }

    public function funcionsubsistemas()
    {
        return $this->hasMany(Funcionsubsistema::class, 'parte_id');
    }

}

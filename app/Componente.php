<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'sistema_id',
    ];

    public function getNombreAttribute()
    {
        return $this->attributes['nombre'];
    }

    public function partes()
    {
        return $this->hasMany(Parte::class);
    }
}

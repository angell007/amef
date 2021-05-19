<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'parte_id',
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

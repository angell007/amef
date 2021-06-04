<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FuncionSubsistema extends Model
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

    public function parte()
    {
        return $this->belongsTo(Parte::class);
    }

    public function funciones()
    {
        return $this->hasMany(Funcion::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sistema extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function getNombreAttribute()
    {
        return $this->attributes['nombre'];
    }

    public function componentes()
    {
        return $this->hasMany(Componente::class);
    }
}

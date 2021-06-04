<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FallaFuncional extends Model
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

    public function modofalla()
    {
        return $this->hasMany(ModoFalla::class);
    }
}

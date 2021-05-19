<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModoFalla extends Model
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
}

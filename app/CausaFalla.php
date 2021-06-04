<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CausaFalla extends Model
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

    public function efectofalla()
    {
        return $this->hasMany(EfectoFalla::class);
    }
}

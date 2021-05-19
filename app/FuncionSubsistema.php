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

    public function modofalla()
    {
        return $this->hasMany(ModoFalla::class, 'parte_id');
    }
    public function efectofalla()
    {
        return $this->hasMany(EfectoFalla::class, 'parte_id');
    }
    public function causafalla()
    {
        return $this->hasMany(CausaFalla::class, 'parte_id');
    }
    public function fallafuncional()
    {
        return $this->hasMany(FallaFuncional::class, 'parte_id');
    }
    public function actividades()
    {
        return $this->hasMany(Actividad::class, 'parte_id');
    }
}

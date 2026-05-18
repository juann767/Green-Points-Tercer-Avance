<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dispositivo extends Model
{
    protected $fillable = [
        'nombre',
        'ubicacion',
        'descripcion',
        'imagen',
        'estado',   // activo | mantenimiento | inactivo
    ];

    public function registros()
    {
        return $this->hasMany(RegistroAccion::class, 'dispositivo_id');
    }
}

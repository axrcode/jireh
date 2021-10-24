<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoEstudiante extends Model
{
    protected $table = 'info_estudiantes';

    protected $fillable = [
        'conexion_internet', 'conexion_tipo', 'conexion_velocidad', 'equipo_tecnologico', 'equipo_tipo', 'estudiante_id'
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }
}

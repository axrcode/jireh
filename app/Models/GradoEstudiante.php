<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradoEstudiante extends Model
{
    protected $table = 'grado_estudiante';

    protected $fillable = [
        'estudiante_id', 'grado_id', 'cicloescolar_id'
    ];

    public function grado()
    {
        return $this->belongsTo(Grados::class);
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

}

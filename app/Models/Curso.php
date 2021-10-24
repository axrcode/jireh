<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'cursos';

    protected $fillable = [
        'nombre', 'periodos', 'curricular', 'grado_id', 'cicloescolar_id'
    ];

    public function grado()
    {
        return $this->belongsTo(Grados::class);
    }

    public function cicloescolar()
    {
        return $this->belongsTo(CicloEscolar::class);
    }

    public function curso_docente()
    {
        return $this->hasOne(CursoDocente::class);
    }
}

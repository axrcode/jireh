<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CursoGrado extends Model
{
    protected $table = 'curso_grado';

    protected $fillable = [
        'curso_id', 'grado_id'
    ];

    /* Relation for Couser of the Asignation */
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    /* Relation for Grade of the Asignation */
    public function grado()
    {
        return $this->belongsTo(Grados::class);
    }

    /* Relation for Teacher of the Asignation */
    public function docente()
    {
        return $this->belongsTo(Colaborador::class);
    }
}

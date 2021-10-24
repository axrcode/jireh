<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CursoDocente extends Model
{
    protected $table = 'curso_docente';

    protected $fillable = [
        'curso_id', 'docente_id'
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function docente()
    {
        return $this->belongsTo(Colaborador::class);
    }
}

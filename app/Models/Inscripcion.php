<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripciones';

    protected $fillable = [
        'estudiante_id', 'codinscripcion_id', 'metodo_pago', 'no_documento', 'monto', 'cicloescolar_id'
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function codigo_inscripcion()
    {
        return $this->belongsTo(CodInscripcion::class);
    }
}

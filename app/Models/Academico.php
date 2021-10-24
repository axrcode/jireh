<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Academico extends Model
{
    protected $table = 'academico';

    protected $fillable = [
        'cicloescolar_id', 'unidad_id', 'empresa_id', 'cicloinscripciones_id'
    ];

    /* Relation for User of the Student */
    public function cicloescolar()
    {
        return $this->belongsTo(CicloEscolar::class);
    }

    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function cicloinscripciones()
    {
        return $this->belongsTo(CicloEscolar::class);
    }
}

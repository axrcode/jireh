<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodInscripcion extends Model
{
    protected $table = 'cod_inscripciones';

    protected $fillable = [
        'id', 'estado'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';

    protected $fillable = [
        'nombre', 'direccion', 'telefono', 'nit', 'director', 'email', 'website'
    ];

    /* Relation for Current Academic System of the Institution */
    public function academico()
    {
        return $this->hasOne(Academico::class);
    }
}

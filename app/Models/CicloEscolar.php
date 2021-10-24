<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CicloEscolar extends Model
{
    protected $table = 'cicloescolar';

    protected $fillable = [ 'ciclo' ];

    /* Relation for School Cycle of the Institution */
    public function academico()
    {
        return $this->hasMany(Academico::class);
    }
}

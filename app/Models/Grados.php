<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grados extends Model
{
    protected $table = 'grados';

    protected $fillable = [
        'nombre', 'seccion', 'nivel', 'cicloescolar_id'
    ];
}

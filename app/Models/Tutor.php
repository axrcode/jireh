<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $table = 'tutores';

    protected $fillable = [
        'nombre', 'dpi', 'telefono', 'direccion', 'email', 'tutor', 'estudiante_id'
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }
}

<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiantes';

    protected $fillable = [
        'id', 'nombre', 'apellido', 'codigo_mineduc', 'fecha_nacimiento', 'ps', 'fotografia',
        'genero', 'lateralidad', 'direccion', 'telefono', 'email', 'estado', 'user_id', 'alergia_medicamento', 'observacion'
    ];

    /* Relation for User of the Student */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /* Relation for Grade of the Student */
    public function asignacion_grado()
    {
        return $this->hasMany(GradoEstudiante::class);
    }

    /* Relation for Tutors of the Student */
    public function tutor()
    {
        return $this->hasMany(Tutor::class);
    }

    public function info()
    {
        return $this->hasOne(InfoEstudiante::class);
    }
}

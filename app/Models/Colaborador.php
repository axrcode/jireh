<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    protected $table = 'colaboradores';

    protected $fillable = [
        'id', 'codigo_empleado', 'nombre', 'apellido', 'dpi', 'fecha_nacimiento',
        'direccion', 'ps', 'telefono', 'telefono_emergencia', 'email', 'profesion',
        'estudios', 'universidad', 'ultimo_anio_universidad', 'cargo', 'tipo_usuario',
        'fecha_alta', 'estado', 'user_id'
    ];

    /* Relation for User of the Collaborator */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

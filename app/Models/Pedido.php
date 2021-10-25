<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    //

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function detallePedido()
    {
        return $this->hasMany(DetallePedido::class);
    }
}

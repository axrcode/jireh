<?php

namespace App\Helpers;

use App\Models\CodInscripcion;

class Generales
{
    public static function __callStatic($method, $args)
    {
        $obj = new BackendFacade;

        return $obj->$method(...$args);
    }
}

class BackendFacade
{
    public function generarCodigoInscripcion()
    {
        do
        {
            $codigo = rand(100000, 999999);

            $codigo_db =  CodInscripcion::where([['id', $codigo], ['estado', true]])->first();
        }
        while ($codigo == $codigo_db);

        return $codigo;
    }
}

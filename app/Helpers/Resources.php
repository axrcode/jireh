<?php

function emptyFieldsCollaborator( $datos )
{
    $empty = 0;

    empty($datos->dpi) ? $empty++ : $empty;
    empty($datos->direccion) ? $empty++ : $empty;
    empty($datos->ps) ? $empty++ : $empty;
    empty($datos->telefono_emergencia) ? $empty++ : $empty;
    empty($datos->profesion) ? $empty++ : $empty;
    empty($datos->estudios) ? $empty++ : $empty;
    empty($datos->universidad) ? $empty++ : $empty;
    empty($datos->ultimo_anio_universidad) ? $empty++ : $empty;
    empty($datos->cargo) ? $empty++ : $empty;
    empty($datos->fecha_alta) ? $empty++ : $empty;

    return $empty;
}

function emptyTexts()
{
    return '<span class="text-danger font-weight-bold"><i class="fas fa-ban"></i></span>';
}

function emptyFieldsStudents( $datos )
{
    $empty = 0;

    //  Student
    empty($datos->codigo_mineduc) ? $empty++ : $empty;
    empty($datos->direccion) ? $empty++ : $empty;
    //  Father
    empty($datos->tutor[0]->nombre) ? $empty++ : $empty;
    empty($datos->tutor[0]->dpi) ? $empty++ : $empty;
    empty($datos->tutor[0]->telefono) ? $empty++ : $empty;
    empty($datos->tutor[0]->direccion) ? $empty++ : $empty;
    empty($datos->tutor[0]->email) ? $empty++ : $empty;
    //  Father
    empty($datos->tutor[1]->nombre) ? $empty++ : $empty;
    empty($datos->tutor[1]->dpi) ? $empty++ : $empty;
    empty($datos->tutor[1]->telefono) ? $empty++ : $empty;
    empty($datos->tutor[1]->direccion) ? $empty++ : $empty;
    empty($datos->tutor[1]->email) ? $empty++ : $empty;
    //  Tutor
    empty($datos->tutor[2]->nombre) ? $empty++ : $empty;
    empty($datos->tutor[2]->dpi) ? $empty++ : $empty;
    empty($datos->tutor[2]->telefono) ? $empty++ : $empty;
    empty($datos->tutor[2]->direccion) ? $empty++ : $empty;
    empty($datos->tutor[2]->email) ? $empty++ : $empty;

    return $empty;
}

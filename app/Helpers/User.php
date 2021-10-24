<?php

function generateCode()
{
    $codigo = date('Y') . rand(10000, 99999);
    return $codigo;
}

function generateUser($nombre, $apellidos, $codigo)
{
    /* OBTIENE LA PRIMERA LETRA DEL PRIMER NOMBRE */
    $primera_letra_nombre = strtoupper($nombre[0]);

    /* OBTIENE SOLAMENTE EL PRIMER APELLIDO */
    list($apellido) = explode(" ", $apellidos);
    $primer_apellido = strtoupper($apellido);

    /* OBTIENE SOLAMENTE EL DIA Y MES DE NACIMIENTO */
    //list($anioNac, $mesNac, $diaNac) = explode("-", $fechanac);

    $usuario = $primera_letra_nombre . $primer_apellido . substr($codigo, 4);

    return $usuario;
}

function generatePS($fecha)
{
    $ps = 0;

    list($anio, $mes, $dia) = explode("-", $fecha);

    for ($i=0; $i<strlen($dia); $i++)
    {
        $ps += $dia[$i];
    }

    for ($i=0; $i<strlen($mes); $i++)
    {
        $ps += $mes[$i];
    }

    for ($i=0; $i<strlen($anio); $i++)
    {
        $ps += $anio[$i];
    }

    while ($ps >= 10)
    {
        $ps = substr($ps, 0, 1) + substr($ps, 1, 1);
    }

    return $ps;
}

function removeAccents($cadena)
{
    //  Reemplazamos la A y a
    $cadena = str_replace(
        array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
        array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
        $cadena
    );

    //  Reemplazamos la E y e
    $cadena = str_replace(
        array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
        array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
        $cadena
    );

    //  Reemplazamos la I y i
    $cadena = str_replace(
        array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
        array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
        $cadena
    );

    //  Reemplazamos la O y o
    $cadena = str_replace(
        array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
        array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
        $cadena
    );

    //  Reemplazamos la U y u
    $cadena = str_replace(
        array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
        array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
        $cadena
    );

    //  Reemplazamos la N, n, C y c
    $cadena = str_replace(
        array('Ñ', 'ñ', 'Ç', 'ç'),
        array('N', 'n', 'C', 'c'),
        $cadena
    );

    return $cadena;
}

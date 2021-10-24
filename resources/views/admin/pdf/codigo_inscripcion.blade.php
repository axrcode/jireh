<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Código de Inscripción</title>

    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }
        body {
            font-family: Arial, Helvetica, sans-serif
        }
        .logo {
            width: 75px;
        }
        .texto-center {
            text-align: center;
        }
        .margen-codigo {
            margin: 20px 0 0 0;
        }
        .principal {
            font-size: 20px;
        }
        .codigo {
            font-size: 35px;
            font-weight: bolder;
            margin: 0;
        }
        .nota {
            font-size: 15px;
        }
        .texto-grey {
            color: grey;
        }
        .info {
            font-size: 10px;
        }
    </style>
</head>
<body>

    <div class="texto-center">
        <img src="{{ $logo }}" alt="Logo" style="margin: 0" class="logo">
        <p class="principal" style="margin: 0">Inscripciones {{ $ciclo_inscripcion }}</p>
    </div>

    <div class="texto-center margen-codigo">
        <p class="codigo">
            {{ $codigo }}
        </p>
        <span class="nota texto-grey">
            Este código es de uso único
        </span>
    </div>

    <div class="texto-center margen-codigo">
        <a href="https://{{ $ruta }}" class="nota">
            {{ $ruta }}
        </a>
    </div>

    <div class="texto-center margen-codigo">
        <p class="info" style="margin: 0">
            {{ $nombre }}
        </p>

        <p class="info texto-grey" style="margin: 0">
            {{ $direccion }}
        </p>

        <p class="info texto-grey" style="margin: 0">
            {{ $telefono }} - {{ $email }} - {{ $website }}
        </p>
    </div>

</body>
</html>

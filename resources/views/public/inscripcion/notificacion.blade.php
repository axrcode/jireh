<style>

    .fondo-notificacion {
        background: #f5f5f5;
        text-align: center;
    }
    .logo-notificacion {
        width: 50%;
    }
    .texto-titulo {
        text-align: center;
        margin-bottom: 30px;
    }
    .contenido {
        width: 100%;
        background: #ffffff;
        padding: 10px;
    }
    .texto-bienvenida {
        text-align: justify;
    }
    table {
        width: 100%;
    }
    .table-grado {
        width: 70%;
        border-bottom: 1px #d0d0d0 solid;
    }
    .table-seccion {
        width: 30%;
        border-bottom: 1px #d0d0d0 solid;
    }
    .padding-tabla {
        padding: 10px 0;
    }
    .texto-grey {
        color: #757575;
    }

    @media (min-width: 600px) {
        .contenido {
            width: 75%;
            margin-left: auto;
            margin-right: auto;
            padding: 25px 50px;
        }
        .logo-notificacion {
            width: 30%;
        }
    }

</style>

<div class="fondo-notificacion">

    <div class="contenido">
        <img
            src="{{ env('APP_URL') . $empresa->logo }}"
            alt="Logo Empresa"
            class="logo-notificacion"
        >

        <h2 class="texto-titulo">
            Inscripción Ciclo Escolar {{ $academico_actual->cicloinscripciones->ciclo }}
        </h2>

        <p class="texto-bienvenida">
            ¡Hola <b>{{ $info_inscripcion->estudiante->user->name }}</b>! Te damos la bienvenida al ciclo escolar {{ $academico_actual->cicloinscripciones->ciclo }}.
            Este mensaje confirma que has sido asignado correctamente al grado o carrera:
        </p>

        <table style="margin-bottom: 20px">
            <thead>
                <tr>
                    <th class="table-grado padding-tabla" style="text-align: left">
                        Grado
                    </th>
                    <th class="table-seccion padding-tabla" style="text-align: right">
                        Sección
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="padding-tabla" style="text-align: left">
                        {{ $info_inscripcion->grado->nombre }}
                    </td>
                    <td class="padding-tabla" style="text-align: right">
                        <b>{{ $info_inscripcion->grado->seccion === null ? '-' : $info_inscripcion->grado->seccion }}</b>
                    </td>
                </tr>
            </tbody>
        </table>

        <p class="texto-bienvenida" style="margin-bottom: 35px">
            Se ha enviado una copia de esta notificación a tu correo electrónico.
            Si tienes alguna duda puedes comunicarte con secretaría o dirección de establecimiento.
        </p>

        <p class="info" style="margin: 0">
            &copy; {{ date('Y') }} {{ $empresa->nombre }}
        </p>

        <p class="info texto-grey" style="margin: 0">
            {{ $empresa->direccion }}
        </p>

        <p class="info texto-grey" style="margin-bottom: 30px">
            {{ $empresa->telefono }} - {{ $empresa->email }} - {{ $empresa->website }}
        </p>

    </div>

</div>


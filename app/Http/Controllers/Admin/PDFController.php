<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Academico;
use App\Models\CodInscripcion;
use App\Models\Empresa;

class PDFController extends Controller
{
    public function __construct()
    {
        //  Company Information
        $this->empresa = Empresa::where('nombre', env('EMPRESA_NAME'))->first();

        //  Current System Academy
        $this->academico_actual = Academico::first();
    }

    public function codigo_inscripcion(CodInscripcion $codigo)
    {
        $data = [
            'codigo'        => $codigo->id,

            'nombre'        => $this->empresa->nombre,
            'direccion'     => $this->empresa->direccion,
            'email'         => $this->empresa->email,
            'telefono'      => $this->empresa->telefono,
            'website'       => $this->empresa->website,
            'logo'          => $this->empresa->logo,

            'ciclo_inscripcion' => $this->academico_actual->cicloescolar->ciclo + 1,
            'ruta'              => env('APP_DOMANIN').'/inscripcion',
        ];

        $configuracion = [
            'format'        => [100, 100],
            'margin_left'   => 5,
            'margin_right'  => 5,
            'margin_top'    => 5
        ];

        $pdf = PDF::loadView('admin.pdf.codigo_inscripcion', $data, [], $configuracion);
        return $pdf->stream('codigo-inscripcion.png');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Academico;
use App\Models\Colaborador;
use App\Models\Empresa;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $empresa;

    public function __construct()
    {
        //  Company Information
        $this->empresa = Empresa::where('nombre', env('EMPRESA_NAME'))->first();

        //  Current System Academy
        $this->academico_actual = Academico::first();

        //  Permisos
        $this->middleware('can:admin.dashboard')->only('index');
    }

    public function index()
    {
        $total_estudiantes = count(Estudiante::all());
        $total_colaboradores = count(Colaborador::all());
        $total_inscripciones = count(Inscripcion::where('cicloescolar_id', $this->academico_actual->cicloinscripciones_id)->get());

        return view('admin.dashboard', [
            'total_estudiantes' => $total_estudiantes,
            'total_colaboradores' => $total_colaboradores,
            'total_inscripciones' => $total_inscripciones,
            'empresa' => $this->empresa,
            'academico_actual' => $this->academico_actual,
        ]);
    }
}

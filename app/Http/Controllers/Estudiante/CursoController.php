<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use App\Models\Academico;
use App\Models\Curso;
use App\Models\Empresa;
use App\Models\GradoEstudiante;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    private $empresa;

    public function __construct()
    {
        //  Company Information
        $this->empresa = Empresa::where('nombre', env('EMPRESA_NAME'))->first();

        //  Current System Academy
        $this->academico_actual = Academico::first();

        //  Permisos
        $this->middleware('can:estudiante.curso.index')->only('index');
        $this->middleware('can:estudiante.curso.show')->only('show');
    }

    public function index()
    {
        $grado_actual_estudiante = GradoEstudiante::where([
            ['estudiante_id', auth()->user()->estudiante->id],
            ['cicloescolar_id', $this->academico_actual->cicloescolar_id]
        ])->first();

        if ( $grado_actual_estudiante )
        {
            $cursos = Curso::where([
                ['grado_id', $grado_actual_estudiante->grado_id],
                ['cicloescolar_id', $this->academico_actual->cicloescolar_id]
            ])->orderBy('nombre', 'ASC')->get();
        }
        else
        {
            $cursos = __('The student has no assigned courses');
        }

        return view('estudiante.curso.index', [
            'empresa' => $this->empresa,
            'cursos' => $cursos
        ]);
    }
}

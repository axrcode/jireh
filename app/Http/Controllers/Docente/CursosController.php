<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use App\Models\Academico;
use App\Models\Curso;
use App\Models\CursoDocente;
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
        $this->middleware('can:docente.curso.index')->only('index');
        $this->middleware('can:docente.curso.show')->only('show');
    }

    public function index()
    {

    }
}

<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use App\Models\Academico;
use App\Models\Curso;
use App\Models\CursoDocente;
use App\Models\Empresa;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    private $empresa;

    public function __construct()
    {
        //  Company Information
        $this->empresa = Empresa::where('nombre', env('EMPRESA_NAME'))->first();

        //  Current Sys tem Academy
        $this->academico_actual = Academico::first();

        //  Permisos
        $this->middleware('can:docente.curso.index')->only('index');
        $this->middleware('can:docente.curso.show')->only('show');
    }

    public function index()
    {
        $id_colaborador = auth()->user()->colaborador->id;

        $cursos_docente = CursoDocente::join('cursos', 'curso_docente.curso_id', '=', 'cursos.id')
            ->join('grados', 'cursos.grado_id', '=', 'grados.id')
            ->where([
                ['curso_docente.docente_id', $id_colaborador],
                ['cursos.cicloescolar_id', $this->academico_actual->cicloescolar_id]
            ])->select(
                'cursos.id as id_curso',
                'cursos.nombre as name_curso',
                'grados.id as id_grado',
                'grados.nombre as name_grado')
            ->get();

        if ( sizeof($cursos_docente) > 0 )
        {
            $cursos = $cursos_docente;
        }
        else
        {
            $cursos = __('The profesor has no assigned courses');
        }

        return view('docente.curso.index', [
            'empresa' => $this->empresa,
            'cursos' => $cursos
        ]);
    }

    /* public function anuncios_index(Curso $curso)
    {
        return view('docente.curso.anuncios.index', [
            'empresa' => $this->empresa,
            'curso' => $curso,
        ]);
    }

    public function actividades_index(Curso $curso)
    {
        return view('docente.curso.actividades.index', [
            'empresa' => $this->empresa,
            'curso' => $curso,
        ]);
    } */
}

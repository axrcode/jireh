<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Academico;
use App\Models\Colaborador;
use App\Models\Curso;
use App\Models\CursoDocente;
use App\Models\CursoGrado;
use App\Models\Empresa;
use App\Models\Grados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class CursoController extends Controller
{
    public function __construct()
    {
        //  Company Information
        $this->empresa = Empresa::where('nombre', env('EMPRESA_NAME'))->first();

        //  Current System Academy
        $this->academico_actual = Academico::first();

        //  Permisos
        $this->middleware('can:admin.curso.index')->only('index');
        $this->middleware('can:admin.curso.create')->only('create', 'store');
        $this->middleware('can:admin.curso.show')->only('show');
        $this->middleware('can:admin.curso.edit')->only('edit', 'update');
        $this->middleware('can:admin.curso.delete')->only('delete', 'destroy');
    }

    public function index()
    {
        return Curso::all();
    }

    public function create(Grados $grado)
    {
        return view('admin.grados.cursos.create', [
            'empresa' => $this->empresa,
            'grado' => $grado
        ]);
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'nombre' => 'required|string'
        ]);

        $courses_grade_exist = Curso::select('cursos.nombre as curso', 'grados.nombre as grado', 'cursos.cicloescolar_id')
            ->where([['cursos.nombre', $request->nombre], ['grados.id', $request->grado], ['cursos.cicloescolar_id', $this->academico_actual->cicloescolar_id]])
            ->join('grados', 'grados.id', '=', 'cursos.grado_id')
            ->get();

        if ( sizeof( $courses_grade_exist ) > 0 )
        {
            return redirect()
                ->route('admin.grado.show', [$request->grado])
                ->with('process_result', [
                    'status' => 'error',
                    'content' => trans('forms-grade.course_create_error')
                ])
            ;
        }
        else
        {
            DB::beginTransaction();

            $curso = Curso::create([
                'nombre' => $request->nombre,
                'periodos' => $request->periodos,
                'curricular' => $request->curricular,
                'grado_id' => $request->grado,
                'cicloescolar_id' => $this->academico_actual->cicloescolar_id
            ]);

            DB::commit();

            return redirect()
                ->route('admin.curso.show', [$request->grado, $curso->id])
                ->with('process_result', [
                    'status' => 'success',
                    'content' => trans('forms-grade.course_create_success')
                ])
            ;
        }
    }

    public function show(Grados $grado, Curso $curso)
    {
        return view('admin.grados.cursos.show', [
            'grado' => $grado,
            'curso' => $curso,
            'empresa' => $this->empresa
        ]);
    }

    public function edit(Grados $grado, Curso $curso)
    {
        return view('admin.grados.cursos.edit', [
            'grado' => $grado,
            'curso' => $curso,
            'empresa' => $this->empresa
        ]);
    }

    public function update(Request $request, Grados $grado, Curso $curso)
    {
        $this->validate(request(), [
            'nombre' => 'required|string'
        ]);

        $courses_grade_exist = Curso::select('cursos.nombre as curso', 'grados.nombre as grado', 'cursos.cicloescolar_id')
            ->where([
                ['cursos.nombre', $request->nombre],
                ['cursos.nombre', '<>', $curso->nombre],
                ['grados.id', $request->grado],
                ['cursos.cicloescolar_id', $this->academico_actual->cicloescolar_id]])
            ->join('grados', 'grados.id', '=', 'cursos.grado_id')
            ->get();

        if ( sizeof( $courses_grade_exist ) > 0 )
        {
            return redirect()
                ->route('admin.curso.show', [$grado->id, $curso->id])
                ->with('process_result', [
                    'status' => 'error',
                    'content' => trans('forms-grade.course_update_error')
                ])
            ;
        }
        else
        {
            DB::beginTransaction();

            $curso->nombre = $request->nombre;
            $curso->periodos = $request->periodos;
            $curso->curricular = $request->curricular;
            $curso->save();

            DB::commit();

            return redirect()
                ->route('admin.curso.show', [$request->grado, $curso->id])
                ->with('process_result', [
                    'status' => 'success',
                    'content' => trans('forms-grade.course_update_success')
                ])
            ;
        }
    }

    public function delete(Grados $grado, Curso $curso)
    {
        return view('admin.grados.cursos.delete', [
            'grado' => $grado,
            'curso' => $curso,
            'empresa' => $this->empresa,
        ]);
    }

    public function destroy(Request $request, Grados $grado, Curso $curso)
    {
        $this->validate(request(), [
            'eliminar' => 'required|string',
            'check' => 'required'
        ]);

        if ( $request->eliminar != __('DELETE') )
        {
            return back()
                ->withErrors(['eliminar' => trans('forms-grade.error_write_delete')])
                ->withInput(request(['eliminar']))
            ;
        }
        else
        {
            DB::beginTransaction();
            $curso->delete();
            DB::commit();

            return redirect()
                ->route('admin.grado.show', [$grado->id])
                ->with('process_result', [
                    'status' => 'success',
                    'content' => trans('forms-grade.course_delete_success')
                ])
            ;
        }
    }

    /**
    * --------------------------------------------------------------------------
    *  Métodos para Cursos asignados al Docente
    * --------------------------------------------------------------------------
    **/

    public function curso_docente_create(Grados $grado, Curso $curso)
    {
        /* $rol_colaborador = $colaborador->user->roles()->first()->name;

        if ( $rol_colaborador == 'Docente' )
        {*/
            $docentes = Role::join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
                ->join('users', 'users.id', '=', 'model_has_roles.model_id')
                ->join('colaboradores', 'users.id', '=', 'colaboradores.user_id')
                ->where('roles.name', 'Docente')
                ->select(
                    'colaboradores.id as id_docente',
                    'users.name',
                    'roles.name as rol',
                )->get();

            return view('admin.grados.cursos.docente.create', [
                'grado' => $grado,
                'curso' => $curso,
                'docentes' => $docentes,
                'empresa' => $this->empresa
            ]);
        //}

        return abort('404');
    }

    public function curso_docente_store(Request $request, Grados $grado, Curso $curso)
    {
        DB::beginTransaction();

        $curso_docente_exist = CursoDocente::where([
            ['curso_id', $curso->id]
        ])->first();

        if ( empty($curso_docente_exist) )
        {
            $curso_docente_new = new CursoDocente;
            $curso_docente_new->curso_id = $curso->id;
            $curso_docente_new->docente_id = $request->id_docente;
            $curso_docente_new->save();
        }
        else
        {
            $curso_docente_exist->docente_id = $request->id_docente;
            $curso_docente_exist->save();
        }

        DB::commit();

        return redirect()
            ->route('admin.curso.show', [$grado->id, $curso->id])
            ->with('process_result', [
                'status' => 'success',
                'content' => 'Docente actualizado con éxito'
            ])
        ;
    }
}

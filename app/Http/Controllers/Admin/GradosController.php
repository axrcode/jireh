<?php

namespace App\Http\Controllers\Admin;

use App\Models\Grados;
use App\Models\Empresa;
use App\Models\Academico;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\GradoEstudiante;
use Illuminate\Support\Facades\DB;

class GradosController extends Controller
{
    private $empresa;

    public function __construct()
    {
        //  Company Information
        $this->empresa = Empresa::where('nombre', env('EMPRESA_NAME'))->first();

        //  Current System Academy
        $this->academico_actual = Academico::first();

        //  Permisos
        $this->middleware('can:admin.grado.index')->only('index');
        $this->middleware('can:admin.grado.create')->only('create', 'store');
        $this->middleware('can:admin.grado.show')->only('show');
        $this->middleware('can:admin.grado.edit')->only('edit', 'update');
        $this->middleware('can:admin.grado.delete')->only('delete', 'destroy');
    }

    public function index()
    {
        $grados = Grados::where('cicloescolar_id', $this->academico_actual->cicloescolar_id)->get();

        return view('admin.grados.index', [
            'grados' => $grados,
            'empresa' => $this->empresa
        ]);
    }

    public function create()
    {
        return view('admin.grados.create', [
            'empresa' => $this->empresa
        ]);
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'nombre' => 'required|string',
            'nivel' => 'required|string'
        ]);

        $grade_exist = Grados::where([
            ['nombre', '=', $request->nombre],
            ['seccion', '=', $request->seccion],
            ['nivel', '=', $request->nivel],
            ['cicloescolar_id', $this->academico_actual->cicloescolar_id]
        ])->get();

        if ( sizeof($grade_exist) > 0 )
        {
            return redirect()
                ->route('admin.grado.index')
                ->with('process_result', [
                    'status' => 'error',
                    'content' => trans('forms-grade.create_error')
                ])
            ;
        }
        else
        {
            DB::beginTransaction();

            Grados::create([
                'nombre' => $request->nombre,
                'seccion' => $request->seccion,
                'nivel' => $request->nivel,
                'cicloescolar_id' => $this->academico_actual->cicloescolar_id
            ]);

            DB::commit();

            return redirect()
                ->route('admin.grado.index')
                ->with('process_result', [
                    'status' => 'success',
                    'content' => trans('forms-grade.create_success')
                ])
            ;
        }
    }

    public function show(Grados $grado)
    {
        if ( $grado->cicloescolar_id == $this->academico_actual->cicloescolar_id )
        {
            $cursos_del_grado = Curso::where([
                ['grado_id', $grado->id],
                ['cicloescolar_id', $this->academico_actual->cicloescolar_id]
            ])->get();

            $estudiantes_del_grado = GradoEstudiante::where([
                ['grado_id', $grado->id],
                ['cicloescolar_id', $this->academico_actual->cicloescolar_id]
            ])->get();

            return view('admin.grados.show', [
                'grado' => $grado,
                'cursos_del_grado' => $cursos_del_grado,
                'estudiantes_del_grado' => $estudiantes_del_grado,
                'empresa' => $this->empresa
            ]);
        }

        return abort('404');
    }

    public function edit(Grados $grado)
    {
        if ( $grado->cicloescolar_id == $this->academico_actual->cicloescolar_id )
        {
            return view('admin.grados.edit', [
                'grado' => $grado,
                'empresa' => $this->empresa
            ]);
        }

        return abort('404');
    }

    public function update(Request $request, Grados $grado)
    {
        $this->validate(request(), [
            'nombre' => 'required|string',
            'nivel' => 'required|string'
        ]);

        $grade_exist = Grados::where([
            ['nombre', '=', $request->nombre],
            ['seccion', '=', $request->seccion],
            ['nivel', '=', $request->nivel],
            ['cicloescolar_id', $this->academico_actual->cicloescolar_id],
            ['id', '<>', $grado->id]
        ])->get();

        if ( sizeof($grade_exist) > 0 )
        {
            return redirect()
                ->route('admin.grado.show', [$grado->id])
                ->with('process_result', [
                    'status' => 'error',
                    'content' => trans('forms-grade.update_error')
                ])
            ;
        }
        else
        {
            DB::beginTransaction();

            $grado->nombre = $request->nombre;
            $grado->seccion = $request->seccion;
            $grado->nivel = $request->nivel;
            $grado->save();

            DB::commit();

            return redirect()
                ->route('admin.grado.show', [$grado->id])
                ->with('process_result', [
                    'status' => 'success',
                    'content' => trans('forms-grade.update_success')
                ])
            ;
        }
    }

    public function delete(Grados $grado)
    {
        return view('admin.grados.delete', [
            'grado' => $grado,
            'empresa' => $this->empresa,
        ]);
    }

    public function destroy(Request $request, Grados $grado)
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
            $cursos_del_grado = Curso::where('grado_id', $grado->id)->get();
            $estudiantes_del_grado = GradoEstudiante::where('grado_id', $grado->id)->get();

            if ( sizeof($cursos_del_grado) > 0  || sizeof($estudiantes_del_grado) > 0 )
            {
                return redirect()
                    ->route('admin.grado.show', [$grado->id])
                    ->with('process_result', [
                        'status' => 'error',
                        'content' => trans('forms-grade.delete_error')
                    ])
                ;
            }
            else
            {
                DB::beginTransaction();
                $grado->delete();
                DB::commit();

                return redirect()
                    ->route('admin.grado.index')
                    ->with('process_result', [
                        'status' => 'success',
                        'content' => trans('forms-grade.delete_success')
                    ])
                ;
            }
        }
    }
}

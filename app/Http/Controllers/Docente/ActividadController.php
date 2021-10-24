<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use App\Models\Academico;
use App\Models\Actividad;
use App\Models\Curso;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActividadController extends Controller
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
        $this->middleware('can:docente.actividad.create')->only('create', 'store');
        $this->middleware('can:docente.actividad.show')->only('show');
        $this->middleware('can:docente.actividad.edit')->only('edit', 'update', 'update_destacado');
        $this->middleware('can:docente.actividad.delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Curso $curso)
    {
        return view('docente.curso.actividades.index', [
            'empresa' => $this->empresa,
            'curso' => $curso,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Curso $curso)
    {
        return view('docente.curso.actividades.create', [
            'empresa' => $this->empresa,
            'curso' => $curso,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Curso $curso)
    {
        $this->validate(request(), [
            'titulo' => 'required|string',
            'punteo' => 'required|integer|min:1',
            'entrega' => 'required|date'
        ]);

        if ( isset($request->destacado) ) {
            $destacado = true;
        } else {
            $destacado = false;
        }

        DB::beginTransaction();

        $actividad =  new Actividad;
        $actividad->titulo = $request->titulo;
        $actividad->descripcion = $request->descripcion;
        $actividad->punteo = $request->punteo;
        $actividad->fecha_apertura = $request->apertura;
        $actividad->fecha_vencimiento = $request->entrega;
        $actividad->fecha_cierre = $request->cierre;
        $actividad->destacado = $destacado;
        $actividad->curso_id = $curso->id;
        $actividad->save();

        DB::commit();

        return redirect()
            ->route('docente.curso.actividades.index', $curso->id)
            ->with('process_result', [
                'status' => 'success',
                'content' => 'Actividad creado exitosamente'
            ])
        ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso, Actividad $actividad)
    {
        return view('docente.curso.actividades.show', [
            'empresa' => $this->empresa,
            'actividad' => $actividad,
            'curso' => $curso,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso, Actividad $actividad)
    {
        return view('docente.curso.actividades.edit', [
            'empresa' => $this->empresa,
            'curso' => $curso,
            'actividad' => $actividad,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curso $curso,  Actividad $actividad)
    {
        $this->validate(request(), [
            'titulo' => 'required|string',
            'punteo' => 'required|integer|min:1',
            'entrega' => 'required|date'
        ]);

        if ( isset($request->destacado) ) {
            $destacado = true;
        } else {
            $destacado = false;
        }

        DB::beginTransaction();

        $actividad->titulo = $request->titulo;
        $actividad->descripcion = $request->descripcion;
        $actividad->punteo = $request->punteo;
        $actividad->fecha_apertura = $request->apertura;
        $actividad->fecha_vencimiento = $request->entrega;
        $actividad->fecha_cierre = $request->cierre;
        $actividad->destacado = $destacado;
        $actividad->save();

        DB::commit();

        return redirect()
            ->route('docente.curso.actividades.index', $curso->id)
            ->with('process_result', [
                'status' => 'success',
                'content' => 'Actividad actualizada exitosamente'
            ])
        ;
    }

    public function update_destacado(Request $request, Curso $curso, Actividad $actividad)
    {
        DB::beginTransaction();

        if ( $actividad->destacado == true) {
            $actividad->destacado = false;
            $estado = 'Desmarcada';
        } else {
            $actividad->destacado = true;
            $estado = 'Marcada';
        }

        $actividad->save();

        DB::commit();

        return redirect()
            ->route('docente.curso.actividades.index', $curso->id)
            ->with('process_result', [
                'status' => 'success',
                'content' => "Actividad $estado como Destacado"
            ])
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso, Actividad $actividad)
    {
        DB::beginTransaction();
        $actividad->delete();
        DB::commit();

        return redirect()
            ->route('docente.curso.actividades.index', $curso->id)
            ->with('process_result', [
                'status' => 'success',
                'content' => 'Actividad Eliminada'
            ])
        ;
    }
}

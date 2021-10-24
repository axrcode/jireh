<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use App\Models\Academico;
use App\Models\Anuncio;
use App\Models\Curso;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnuncioController extends Controller
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
        $this->middleware('can:docente.anuncio.create')->only('create', 'store');
        $this->middleware('can:docente.anuncio.show')->only('show');
        $this->middleware('can:docente.anuncio.edit')->only('edit', 'update', 'update_destacado');
        $this->middleware('can:docente.anuncio.delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Curso $curso)
    {
        return view('docente.curso.anuncios.index', [
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
        return view('docente.curso.anuncios.create', [
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
        ]);

        if ( isset($request->destacado) ) {
            $destacado = true;
        } else {
            $destacado = false;
        }

        DB::beginTransaction();

        $anuncio =  new Anuncio;
        $anuncio->titulo = $request->titulo;
        $anuncio->descripcion = $request->descripcion;
        $anuncio->destacado = $destacado;
        $anuncio->curso_id = $curso->id;
        $anuncio->save();

        DB::commit();

        return redirect()
            ->route('docente.curso.anuncios.index', $curso->id)
            ->with('process_result', [
                'status' => 'success',
                'content' => 'Anuncio creado exitosamente'
            ])
        ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anuncio  $anuncio
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso, Anuncio $anuncio)
    {
        return view('docente.curso.anuncios.show', [
            'empresa' => $this->empresa,
            'anuncio' => $anuncio,
            'curso' => $curso,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Anuncio  $anuncio
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso, Anuncio $anuncio)
    {
        return view('docente.curso.anuncios.edit', [
            'empresa' => $this->empresa,
            'curso' => $curso,
            'anuncio' => $anuncio,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Anuncio  $anuncio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curso $curso, Anuncio $anuncio)
    {
        $this->validate(request(), [
            'titulo' => 'required|string',
        ]);

        if ( isset($request->destacado) ) {
            $destacado = true;
        } else {
            $destacado = false;
        }

        DB::beginTransaction();

        $anuncio->titulo = $request->titulo;
        $anuncio->descripcion = $request->descripcion;
        $anuncio->destacado = $destacado;
        $anuncio->save();

        DB::commit();

        return redirect()
            ->route('docente.curso.anuncios.index', $curso->id)
            ->with('process_result', [
                'status' => 'success',
                'content' => 'Anuncio actualizado exitosamente'
            ])
        ;
    }

    public function update_destacado(Request $request, Curso $curso, Anuncio $anuncio)
    {
        DB::beginTransaction();

        if ( $anuncio->destacado == true) {
            $anuncio->destacado = false;
            $estado = 'Desmarcado';
        } else {
            $anuncio->destacado = true;
            $estado = 'Marcado';
        }

        $anuncio->save();

        DB::commit();

        return redirect()
            ->route('docente.curso.anuncios.index', $curso->id)
            ->with('process_result', [
                'status' => 'success',
                'content' => "Anuncio $estado como Destacado"
            ])
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anuncio  $anuncio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso, Anuncio $anuncio)
    {
        DB::beginTransaction();
        $anuncio->delete();
        DB::commit();

        return redirect()
            ->route('docente.curso.anuncios.index', $curso->id)
            ->with('process_result', [
                'status' => 'success',
                'content' => 'Anuncio Eliminado'
            ])
        ;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\Empleado;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeptoController extends Controller
{
    private $empresa;
    public function __construct()
    {
        //  Company Information
        $this->empresa = Empresa::where('nombre', env('EMPRESA_NAME'))->first();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamentos = Departamento::all();

        return view('admin.departamentos.index', [
            'departamentos' => $departamentos,
            'empresa' => $this->empresa
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string'
        ]);

        DB::beginTransaction();

        $depto = new Departamento;
        $depto->nombre = $request->nombre;
        $depto->save();

        DB::commit();

        return redirect()
        ->route('admin.departamentos.index')
        ->with('process_result', [
            'status' => 'success',
            'content' => 'Departamento creado correctamente'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function show(Departamento $departamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Departamento $departamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departamento $departamento)
    {
        $this->validate($request, [
            'nombre' => 'required|string'
        ]);

        DB::beginTransaction();

        $departamento->nombre = $request->nombre;
        $departamento->save();

        DB::commit();

        return redirect()
        ->route('admin.departamentos.index')
        ->with('process_result', [
            'status' => 'success',
            'content' => 'Departamento actualizado correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departamento $departamento)
    {
        $empleados_depto = Empleado::where('departamento_id', $departamento->id)->get();

        if ( sizeof($empleados_depto) > 0 ) {

            $departamento->estado = 'inactivo';
            $departamento->save();

            return redirect()
            ->route('admin.departamentos.index')
            ->with('process_result', [
                'status' => 'info',
                'content' => 'El departamento ha sido inactivado ya que tiene empleados asociados. Esto desactiva el acceso a los usuarios'
            ]);
        } else {

            $departamento->delete();

            return redirect()
            ->route('admin.departamentos.index')
            ->with('process_result', [
                'status' => 'success',
                'content' => 'Departamento eliminado correctamente'
            ]);
        }
    }
}

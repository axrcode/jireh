<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Academico;
use App\Models\CicloEscolar;
use App\Models\Empresa;
use App\Models\Unidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfigGeneralController extends Controller
{
    public function __construct()
    {
        //  Company Information
        $this->empresa = Empresa::where('nombre', env('EMPRESA_NAME'))->first();

        //  Current System Academy
        $this->academico_actual = Academico::first();

        //  Permisos
        $this->middleware('can:admin.configuracion.generales')->only('generales', 'generales_update');
    }

    public function generales()
    {
        return view('admin.configuracion.generales', [
            'empresa' => $this->empresa,
            'academico_actual' => $this->academico_actual,
            'ciclos_escolares' => CicloEscolar::all(),
            'unidades' => Unidad::all(),
        ]);
    }

    public function generales_update(Request $request)
    {
        DB::beginTransaction();

        $this->empresa->update([
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'director' => $request->director
        ]);

        $this->academico_actual->update([
            'cicloescolar_id' => $request->cicloescolar,
            'unidad_id' => $request->unidad,
            'cicloinscripciones_id' => $request->cicloinscripciones
        ]);

        DB::commit();

        return redirect()
            ->route('admin.configuracion.generales')
            ->with('process_result', [
                'status' => 'success',
                'content' => trans('forms-general.update_success')
            ])
        ;
    }
}

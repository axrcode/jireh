<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CodInscripcion;
use App\Models\Empresa;
use Illuminate\Http\Request;

use App\Helpers\Generales;
use App\Models\Academico;
use Illuminate\Support\Facades\DB;

class InscripcionesController extends Controller
{
    public function __construct()
    {
        //  Company Information
        $this->empresa = Empresa::where('nombre', env('EMPRESA_NAME'))->first();

        //  Current System Academy
        $this->academico_actual = Academico::first();

        //  Permisos
        $this->middleware('can:admin.inscripcion.codigo.create')->only('codigo_create', 'codigo_store', 'codigo_destroy');
        $this->middleware('can:admin.inscripcion.codigo.show')->only('codigo_show');
    }

    /**
     * --------------------------------------------------------------------------
     *  Métodos para códigos de inscripciones en línea
     * --------------------------------------------------------------------------
    **/

    public function codigo_create()
    {
        $codigos_inscripciones = CodInscripcion::where('estado', true)->get();

        $codigo_sugerido = Generales::generarCodigoInscripcion();

        return view('admin.inscripciones.codigo.index', [
            'empresa' => $this->empresa,
            'codigos_inscripciones' => $codigos_inscripciones,
            'codigo_sugerido' => $codigo_sugerido,
        ]);
    }

    public function codigo_store(Request $request)
    {
        DB::beginTransaction();

        CodInscripcion::create([
            'id' => $request->new_codigo
        ]);

        DB::commit();

        return redirect()
            ->route('admin.inscripcion.codigo.create')
            ->with('process_result', [
                'status' => 'success',
                'content' => 'Código para inscripción creado'
            ])
        ;
    }

    public function codigo_show(CodInscripcion $codigo)
    {
        $data = [
            'codigo'        => $codigo->id,

            'nombre'        => $this->empresa->nombre,
            'direccion'     => $this->empresa->direccion,
            'email'         => $this->empresa->email,
            'telefono'      => $this->empresa->telefono,
            'website'       => $this->empresa->website,
            'logo'          => $this->empresa->logo,

            'ciclo_inscripcion' => $this->academico_actual->cicloescolar->ciclo + 1,
            'ruta'              => env('APP_DOMANIN').'/inscripcion',
        ];

        return view('admin.pdf.codigo_inscripcion', $data);
    }

    public function codigo_destroy(CodInscripcion $codigo)
    {
        if ($codigo->estado == true)
        {
            DB::beginTransaction();
            $codigo->delete();
            DB::commit();

            return redirect()
                ->route('admin.inscripcion.codigo.create')
                ->with('process_result', [
                    'status' => 'success',
                    'content' => 'Código eliminado correctamente'
                ])
            ;
        }

        return abort('404');
    }
}

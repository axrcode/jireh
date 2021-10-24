<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Academico;
use App\Models\Empresa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FotoController extends Controller
{
    public function __construct()
    {
        //  Company Information
        $this->empresa = Empresa::where('nombre', env('EMPRESA_NAME'))->first();

        //  Current System Academy
        $this->academico_actual = Academico::first();

        //  Permisos
        $this->middleware('can:admin.foto')->only('index', 'update');
    }

    public function index(User $user)
    {
        if ( empty($user->colaborador) )
        {
            $usuario = $user->estudiante;
            $is_colaborador = false;
        }
        else
        {
            $usuario = $user->colaborador;
            $is_colaborador = true;
        }

        return view('admin.usuarios.foto.index', [
            'empresa' => $this->empresa,
            'usuario' => $usuario,
            'is_colaborador' => $is_colaborador,

        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->validate(request(), [
            'foto' => 'required|image',
        ]);

        DB::beginTransaction();

        //  Obtenemos la foto del request
        $foto = $request->file('foto');

        //  Validamos si el usuarioe s colaborador o estudiante
        if ( empty($user->colaborador) )
        {
            $usuario = $user->estudiante;
            $ruta = 'storage/estudiantes';
            $is_colaborador = false;
        }
        else
        {
            $usuario = $user->colaborador;
            $ruta = 'storage/colaboradores';
            $is_colaborador = true;
        }

        //  Guardar foto en el Storage
        $name = $usuario->id . '.' . $foto->extension();
        $foto->move( public_path($ruta), $name );

        //  Guardar ruta de al foto en la base de datos
        $usuario->fotografia = "/$ruta/$name";
        $usuario->save();

        DB::commit();

        if ( $is_colaborador == true )
        {
            return redirect()
                ->route('admin.colaborador.show', [$usuario->id])
                ->with('process_result', [
                    'status' => 'success',
                    'content' => 'Foto cambia con exito'
                ])
            ;
        }
        else
        {
            return redirect()
                ->route('admin.estudiante.show', [$usuario->id])
                ->with('process_result', [
                    'status' => 'success',
                    'content' => trans('forms-general.update_photo_success')
                ])
            ;
        }

    }
}

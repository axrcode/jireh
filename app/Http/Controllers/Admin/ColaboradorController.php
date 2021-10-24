<?php

namespace App\Http\Controllers\Admin;

use App\Models\Empresa;
use App\Models\Colaborador;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Academico;
use App\Models\CursoDocente;
use App\Models\Rol;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ColaboradorController extends Controller
{
    private $empresa;

    public function __construct()
    {
        //  Company Information
        $this->empresa = Empresa::where('nombre', env('EMPRESA_NAME'))->first();

        //  Current System Academy
        $this->academico_actual = Academico::first();

        //  Permisos
        $this->middleware('can:admin.colaborador.index')->only('index');
        $this->middleware('can:admin.colaborador.create')->only('create', 'store');
        $this->middleware('can:admin.colaborador.show')->only('show');
        $this->middleware('can:admin.colaborador.edit')->only('edit', 'update');
    }

    public function index()
    {
        $colaboradores = Colaborador::where('estado', 'activo')->orderBy('apellido', 'ASC')->get();

        return view('admin.colaboradores.index', [
            'colaboradores' => $colaboradores,
            'empresa' => $this->empresa
        ]);
    }

    public function create()
    {
        //$roles = Rol::all();
        $roles = Role::where([['name', '<>', 'Super Administrador'], ['name', '<>', 'Estudiante']])->get();

        return view('admin.colaboradores.create', [
            'roles' => $roles,
            'empresa' => $this->empresa
        ]);
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'fecha' => 'required|string',
            'telefono' => 'required|string',
            'email' => 'required|string',
            //'usuario' => 'required|integer',
        ]);

        //  Generate PS
        $ps = generatePS($request->fecha);

        //  Generate Code
        $code = generateCode();

        //  Generate User
        $usuario = generateUser(
            trim( removeAccents($request->nombre) ),
            trim( removeAccents($request->apellido) ),
            trim( $code )
        );

        DB::beginTransaction();

        $user = User::create([
            'name' => "$request->nombre $request->apellido",
            'user' => $usuario,
            'email' => $request->email,
            'password' => Hash::make( $code ),
            'credential' => $code,
            //'rol_id' => $request->usuario,
        ]);

        $user->roles()->sync($request->usuario);

        Colaborador::create([
            'id' => $code,
            'codigo_empleado' => '202102',
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'dpi' => $request->dpi,
            'fecha_nacimiento' => $request->fecha,
            'direccion' => $request->direccion,
            'ps' => $ps,
            'telefono' => $request->telefono,
            'telefono_emergencia' => $request->telefono_em,
            'email' => $request->email,
            'profesion' => $request->profesion,
            'estudios' => $request->estudios,
            'universidad' => $request->universidad,
            'ultimo_anio_universidad' => $request->ultimo_anio,
            'cargo' => $request->cargo,
            'fecha_alta' => $request->fecha_alta,
            'user_id' => $user->id
        ]);

        DB::commit();

        return redirect()
            ->route('admin.colaborador.index')
            ->with('process_result', [
                'status' => 'success',
                'content' => trans('forms-collaborator.create_success')
            ])
        ;
    }

    public function show(Colaborador $colaborador)
    {
        return view('admin.colaboradores.show', [
            'colaborador' => $colaborador,
            'empty_text' => emptyTexts(),
            'empty_fields' => emptyFieldsCollaborator($colaborador),
            'empresa' => $this->empresa
        ]);
    }

    public function edit(Colaborador $colaborador)
    {
        $roles = Role::where([['name', '<>', 'Super Administrador'], ['name', '<>', 'Estudiante']])->get();

        return view('admin.colaboradores.edit', [
            'roles' => $roles,
            'colaborador' => $colaborador,
            'empresa' => $this->empresa
        ]);
    }

    public function update(Request $request, Colaborador $colaborador)
    {
        $this->validate(request(), [
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'fecha' => 'required|string',
            'telefono' => 'required|string',
            'email' => 'required|string',
            //'usuario' => 'required|integer',
        ]);

        DB::beginTransaction();

        //  Update in table Colaboradores
        $colaborador->nombre = $request->nombre;
        $colaborador->apellido = $request->apellido;
        $colaborador->fecha_nacimiento = $request->fecha;
        $colaborador->ps = generatePS($request->fecha);
        $colaborador->dpi = $request->dpi;
        $colaborador->direccion = $request->direccion;
        $colaborador->telefono = $request->telefono;
        $colaborador->telefono_emergencia = $request->telefono_em;
        $colaborador->email = $request->email;
        $colaborador->profesion = $request->profesion;
        $colaborador->estudios = $request->estudios;
        $colaborador->universidad = $request->universidad;
        $colaborador->ultimo_anio_universidad = $request->ultimo_anio;
        $colaborador->cargo = $request->cargo;
        $colaborador->fecha_alta = $request->fecha_alta;

        //  Update Collaborator's User
        $colaborador->user->name = "$request->nombre $request->apellido";
        $colaborador->user->user = generateUser( trim( removeAccents($request->nombre) ) , trim( removeAccents($request->apellido) ) , trim($request->fecha) );
        $colaborador->user->email = $request->email;
        //$colaborador->user->rol_id = $request->usuario;

        $colaborador->user->roles()->sync($request->usuario);

        //  Save Changes
        $colaborador->save();
        $colaborador->user->save();

        DB::commit();

        return redirect()
            ->route('admin.colaborador.show', [$colaborador->id])
            ->with('process_result', [
                'status' => 'success',
                'content' => trans('forms-collaborator.update_success')
            ])
        ;
    }

    public function destroy(Colaborador $colaborador)
    {
        //
    }

    /**
     * --------------------------------------------------------------------------
     *  Métodos para Cursos asignados al Docente
     * --------------------------------------------------------------------------
    **/

    public function cursos_index(Colaborador $colaborador)
    {
        $rol_colaborador = $colaborador->user->roles()->first()->name;

        if ( $rol_colaborador == 'Docente' )
        {
            $cursos = CursoDocente::join('cursos', 'curso_docente.curso_id', '=', 'cursos.id')
                ->where([
                    ['cursos.cicloescolar_id', $this->academico_actual->cicloescolar_id],
                    ['curso_docente.docente_id', $colaborador->id]
                ])->get();

            return view('admin.colaboradores.cursos.index', [
                'cursos' => $cursos,
                'colaborador' => $colaborador,
                'empresa' => $this->empresa
            ]);
        }

        return abort('404');
    }

    public function cursos_create(Colaborador $colaborador)
    {
        $rol_colaborador = $colaborador->user->roles()->first()->name;

        if ( $rol_colaborador == 'Docente' )
        {
            $cursos = CursoDocente::where('docente_id', $colaborador->id)->get();

            return view('admin.colaboradores.cursos.create', [
                'cursos' => $cursos,
                'colaborador' => $colaborador,
                'empresa' => $this->empresa
            ]);
        }

        return abort('404');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Empresa;
use App\Models\Empleado;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;

class EmpleadoController extends Controller
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
        $empleados = Empleado::where('id','>',1)->get();

        return view('admin.empleados.index', [
            'empleados' => $empleados,
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
        $roles = Role::where('name', '<>', 'None')->get();
        $departamentos = Departamento::where('estado', 'activo')->get();

        return view('admin.empleados.create', [
            'empresa' => $this->empresa,
            'departamentos' => $departamentos,
            'roles' => $roles,
        ]);
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
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'depto' => 'required',
        ]);

        DB::beginTransaction();

        /* OBTIENE EL CORRELATIVO DEL EMPLEADO */
        $correlative = intval(Empleado::max(DB::Raw('coalesce(correlative,0)')))+1;
        $correlative = str_pad($correlative, 3, "0", STR_PAD_LEFT);

        $usuario = new User;
        $usuario->name = $request->nombre .' '. $request->apellido;
        $usuario->email = $request->email;

        if ( $request->password != null )
        {
            /* OBTIENE LA PRIMERA LETRA DEL PRIMER NOMBRE */
            $primera_letra_nombre = strtoupper($request->nombre[0]);

            /* OBTIENE SOLAMENTE EL PRIMER APELLIDO */
            list($apellido) = explode(" ", $request->apellido);
            $primer_apellido = strtoupper($apellido);

            $user = $primera_letra_nombre . $primer_apellido . $correlative;

            $usuario->user = $user;
            $usuario->password = Hash::make($request->password);
            $usuario->credential = $request->password;
        }

        $usuario->save();

        if ( $request->role == 0 ) {
            $role = Role::where('name','None')->value('id');
        } else {
            $role = $request->role;
        }

        $usuario->roles()->sync($role);

        $empleado = new Empleado;
        $empleado->nombre = $request->nombre;
        $empleado->apellido = $request->apellido;
        $empleado->dpi = $request->dpi;
        $empleado->fecha_nacimiento = $request->fecha_nac;
        $empleado->direccion = $request->direccion;
        $empleado->telefono = $request->telefono;
        $empleado->cargo = $request->cargo;
        $empleado->fecha_alta = $request->fecha_alta;
        $empleado->user_id = $usuario->id;
        $empleado->departamento_id = $request->depto;
        $empleado->correlative = $correlative;
        $empleado->save();

        DB::commit();

        return redirect()
        ->route('admin.empleados.index')
        ->with('process_result', [
            'status' => 'success',
            'content' => 'Nuevo empleado creado exitosamente'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        $roles = Role::all();
        $departamentos = Departamento::where('estado', 'activo')->get();

        $role_id = $empleado->user->roles()->first()->pivot->role_id;

        return view('admin.empleados.edit', [
            'empresa' => $this->empresa,
            'departamentos' => $departamentos,
            'roles' => $roles,
            'empleado' => $empleado,
            'role_id' => $role_id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        $this->validate($request, [
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'depto' => 'required',
        ]);

        DB::beginTransaction();

        /* OBTIENE EL CORRELATIVO DEL EMPLEADO */
        $correlative = intval($empleado->correlative);
        $correlative = str_pad($correlative, 3, "0", STR_PAD_LEFT);

        $usuario = User::find($empleado->user_id);
        $usuario->name = $request->nombre .' '. $request->apellido;
        $usuario->email = $request->email;

        if ( $request->password != null )
        {
            /* OBTIENE LA PRIMERA LETRA DEL PRIMER NOMBRE */
            $primera_letra_nombre = strtoupper($request->nombre[0]);

            /* OBTIENE SOLAMENTE EL PRIMER APELLIDO */
            list($apellido) = explode(" ", $request->apellido);
            $primer_apellido = strtoupper($apellido);

            $user = $primera_letra_nombre . $primer_apellido . $correlative;

            $usuario->user = $user;
            $usuario->password = Hash::make($request->password);
            $usuario->credential = $request->password;
        }

        $usuario->save();

        $usuario->roles()->sync($request->role);

        $empleado->nombre = $request->nombre;
        $empleado->apellido = $request->apellido;
        $empleado->dpi = $request->dpi;
        $empleado->fecha_nacimiento = $request->fecha_nac;
        $empleado->direccion = $request->direccion;
        $empleado->telefono = $request->telefono;
        $empleado->cargo = $request->cargo;
        $empleado->fecha_alta = $request->fecha_alta;
        $empleado->user_id = $usuario->id;
        $empleado->departamento_id = $request->depto;
        $empleado->correlative = $correlative;
        $empleado->save();

        DB::commit();

        return redirect()
        ->route('admin.empleados.index')
        ->with('process_result', [
            'status' => 'success',
            'content' => 'Empleado actualizado exitosamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        DB::beginTransaction();

        if ( $empleado->estado == 'activo' ) {
            $empleado->estado = 'inactivo';
            $msg = 'Empleado inactivado para el sistema.';
        } else {
            $empleado->estado = 'activo';
            $msg = 'Empleado activado para el sistema.';
        }

        $empleado->save();

        DB::commit();

        return redirect()
        ->route('admin.empleados.index')
        ->with('process_result', [
            'status' => 'success',
            'content' => $msg
        ]);
    }
}

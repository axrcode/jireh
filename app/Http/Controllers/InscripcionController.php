<?php

namespace App\Http\Controllers;

use App\Mail\NotificacionInscripcion;
use App\Models\Academico;
use App\Models\CodInscripcion;
use App\Models\Empresa;
use App\Models\Estudiante;
use App\Models\GradoEstudiante;
use App\Models\Grados;
use App\Models\InfoEstudiante;
use App\Models\Inscripcion;
use App\Models\Tutor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class InscripcionController extends Controller
{
    public function __construct()
    {
        //  Company Information
        $this->empresa = Empresa::where('nombre', env('EMPRESA_NAME'))->first();

        //  Current System Academy
        $this->academico_actual = Academico::first();
    }

    public function index()
    {
        return view('public.inscripcion.index',[
            'empresa' => $this->empresa,
        ]);
    }

    public function validacion(Request $request)
    {
        $this->validate(request(), [
            'codigo' => 'required|size:6'
        ]);

        $codigo_inscripcion = CodInscripcion::where([['id', $request->codigo], ['estado', true]])->first();

        if ( empty($codigo_inscripcion) )
        {
            $codigo_usado = Inscripcion::where('codinscripcion_id', $request->codigo)->first();

            if ( empty($codigo_usado) )
            {
                return back()->withErrors(['codigo' => 'El código ingresado no es válido']);
            }
            else
            {
                $estudiante_inscrito = GradoEstudiante::where([
                    ['estudiante_id',$codigo_usado->estudiante_id],
                    ['cicloescolar_id', $this->academico_actual->cicloinscripciones_id]
                ])->first();

                if ( empty($estudiante_inscrito) )
                {
                    return redirect()->route('public.inscripcion.grado')->with('info_inscripcion', $codigo_usado);
                }
                else
                {
                    return back()->withErrors(['codigo' => 'El código ingresado no es válido']);
                }
            }
        }
        else
        {
            return redirect()->route('public.inscripcion.create')->with('codigo_activo_inscripcion', $codigo_inscripcion);
        }
    }

    public function create()
    {
        if ( session()->has('codigo_activo_inscripcion') )
        {
            return view('public.inscripcion.create', [
                'codigo_inscripcion' => session('codigo_activo_inscripcion'),
                'empresa' => $this->empresa,
                'academico_actual' => $this->academico_actual,
            ]);
        }

        return redirect()->route('public.inscripcion.index');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'fecha' => 'required|string',
            'genero' => 'required|string',
            'telefono' => 'required|string',
            'email' => 'required|email',
            'metodo_pago' => 'required|string',
            'no_documento' => 'required|string',
            'monto' => 'required|string',
        ]);

        //  Generate PS
        $ps = generatePS( $request->fecha );

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
        ]);

        // Obtener el rol de estudiante de la base de datos
        $rol_estudiante = Role::where('name', 'Estudiante')->first();

        //  Crear Rol de Estudiante
        $user->roles()->sync( $rol_estudiante->id );

        Estudiante::create([
            'id' => $code,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'codigo_mineduc' => $request->mineduc,
            'fecha_nacimiento' => $request->fecha,
            'ps' => $ps,
            'genero' => $request->genero,
            'lateralidad' => $request->lateralidad,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'alergia_medicamento' => $request->alergia_medicamento,
            'observacion' => $request->observacion,
            'user_id' => $user->id
        ]);

        Tutor::create([
            'nombre' => $request->nombre_padre,
            'dpi' => $request->dpi_padre,
            'telefono' => $request->telefono_padre,
            'direccion' => $request->direccion_padre,
            'email' => $request->email_padre,
            'tutor' => 'padre',
            'estudiante_id' => $code
        ]);

        Tutor::create([
            'nombre' => $request->nombre_madre,
            'dpi' => $request->dpi_madre,
            'telefono' => $request->telefono_madre,
            'direccion' => $request->direccion_madre,
            'email' => $request->email_madre,
            'tutor' => 'madre',
            'estudiante_id' => $code
        ]);

        Tutor::create([
            'nombre' => $request->nombre_tutor,
            'dpi' => $request->dpi_tutor,
            'telefono' => $request->telefono_tutor,
            'direccion' => $request->direccion_tutor,
            'email' => $request->email_tutor,
            'tutor' => 'otro',
            'estudiante_id' => $code
        ]);

        $info_inscripcion = Inscripcion::create([
            'estudiante_id' => $code,
            'codinscripcion_id' => $request->codigo_inscripcion,
            'metodo_pago' => $request->metodo_pago,
            'no_documento' => $request->no_documento,
            'monto' => $request->monto,
            'cicloescolar_id' => $this->academico_actual->cicloinscripciones_id,
        ]);

        $request->conexion_internet == '1' ? $conexion_internet = true : $conexion_internet = false;
        $request->equipo == '1' ? $equipo = true : $equipo = false;

        InfoEstudiante::create([
            'conexion_internet' => $conexion_internet,
            'conexion_tipo' => $request->conexion_tipo,
            'conexion_velocidad' => $request->conexion_velocidad,
            'equipo_tecnologico' => $equipo,
            'equipo_tipo' => $request->equipo_tipo,
            'estudiante_id' => $code
        ]);

        $codigo_inscripcion = CodInscripcion::find($request->codigo_inscripcion);
        $codigo_inscripcion->estado = false;
        $codigo_inscripcion->save();

        DB::commit();

        return redirect()
            ->route('public.inscripcion.grado')
            ->with('info_inscripcion', $info_inscripcion)
            ->with('process_result', [
                'status' => 'success',
                'content' => trans('forms-students.enroll_success')
            ])
        ;
    }

    public function seleccionar_grado()
    {
        if ( session()->has('info_inscripcion') )
        {
            $grados = Grados::where('cicloescolar_id', $this->academico_actual->cicloinscripciones_id)->get();

            return view('public.inscripcion.grados', [
                'info_inscripcion' => session('info_inscripcion'),
                'empresa' => $this->empresa,
                'academico_actual' => $this->academico_actual,
                'grados' => $grados,
            ]);
        }

        return redirect()->route('public.inscripcion.index');
    }

    public function asignar_grado(Request $request)
    {
        DB::beginTransaction();

        $info_inscripcion = GradoEstudiante::create([
            'estudiante_id' => $request->estudiante_id,
            'grado_id' => $request->grado_id,
            'cicloescolar_id' => $this->academico_actual->cicloinscripciones_id,
        ]);

        DB::commit();

        $estudiante = Estudiante::find($request->estudiante_id);
        $empresa = $this->empresa;
        $academico_actual = $this->academico_actual;

        Mail::to( $estudiante->email )->queue(
            new NotificacionInscripcion($info_inscripcion, $empresa, $academico_actual)
        );

        return redirect()
            ->route('public.inscripcion.exitosa')
            ->with('info_inscripcion', $info_inscripcion)
            ->with('process_result', [
                'status' => 'success',
                'content' => trans('forms-students.enroll_success')
            ])
        ;
    }

    public function exitosa()
    {
        if ( session()->has('info_inscripcion') )
        {
            return view('public.inscripcion.exitosa', [
                'info_inscripcion' => session('info_inscripcion'),
                'empresa' => $this->empresa,
                'academico_actual' => $this->academico_actual,
            ]);
        }

        return redirect()->route('public.inscripcion.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Empresa;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Academico;
use App\Models\GradoEstudiante;
use App\Models\Grados;
use App\Models\InfoEstudiante;
use App\Models\Tutor;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Ui\Presets\React;
use Spatie\Permission\Models\Role;

class EstudianteController extends Controller
{
    private $empresa;
    private $academico_actual;

    public function __construct()
    {
        //  Company Information
        $this->empresa = Empresa::where('nombre', env('EMPRESA_NAME'))->first();

        //  Current System Academy
        $this->academico_actual = Academico::first();

        //  Permisos
        $this->middleware('can:admin.estudiante.index')->only('index');
        $this->middleware('can:admin.estudiante.show')->only('show');
        $this->middleware('can:admin.estudiante.create')->only('create', 'store');
        $this->middleware('can:admin.estudiante.edit')->only('edit', 'update');
        $this->middleware('can:admin.estudiante.inscripcion')->only('inscripcion');
        $this->middleware('can:admin.estudiante.confirmarinscripcion')->only('confirmarinscripcion', 'inscribir');
        $this->middleware('can:admin.estudiante.cambiargrado')->only('cambiargrado');
        $this->middleware('can:admin.estudiante.confirmargrado')->only('confirmargrado', 'nuevogrado');
    }

    public function index()
    {
        $estudiantes = Estudiante::where('estado', 'activo')->orderBy('apellido', 'ASC')->get();

        return view('admin.estudiantes.index', [
            'estudiantes' => $estudiantes,
            'empresa' => $this->empresa,
            'academico_actual' => $this->academico_actual
        ]);
    }

    public function create()
    {
        $grados = Grados::all();

        return view('admin.estudiantes.create', [
            'grados' => $grados,
            'empresa' => $this->empresa
        ]);
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'fecha' => 'required|string',
            'genero' => 'required|string',
            'telefono' => 'required|string',
            'email' => 'required|email'
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
            //'rol_id' => 7
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

        DB::commit();

        return redirect()
            ->route('admin.estudiante.inscripcion', [$code])
            ->with('process_result', [
                'status' => 'success',
                'content' => trans('forms-students.create_success')
            ])
        ;
    }

    public function show(Estudiante $estudiante)
    {
        $empty_fields = emptyFieldsStudents($estudiante);

        $empty_text = '<span class="text-danger font-weight-bold"><i class="fas fa-ban"></i></span>';

        return view('admin.estudiantes.show', [
            'estudiante' => $estudiante,
            'empty_text' => $empty_text,
            'empty_fields' => $empty_fields,
            'empresa' => $this->empresa,
            'academico_actual' => $this->academico_actual,
        ]);
    }

    public function edit(Estudiante $estudiante)
    {
        $grados = Grados::all();

        return view('admin.estudiantes.edit', [
            'grados' => $grados,
            'estudiante' => $estudiante,
            'empresa' => $this->empresa
        ]);
    }

    public function update(Request $request, Estudiante $estudiante)
    {
        $this->validate(request(), [
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'fecha' => 'required|string',
            'genero' => 'required|string',
            'lateralidad' => 'required|string',
            'telefono' => 'required|string',
        ]);

        //  Generate User
        $usuario = generateUser(
            trim( removeAccents($request->nombre) ),
            trim( removeAccents($request->apellido) ),
            trim( $estudiante->id )
        );

        //  Generate PS
        $ps = generatePS($request->fecha);

        DB::beginTransaction();

        //  Updated Student's Information
        $estudiante->nombre = $request->nombre;
        $estudiante->apellido = $request->apellido;
        $estudiante->codigo_mineduc = $request->mineduc;
        $estudiante->fecha_nacimiento = $request->fecha;
        $estudiante->ps = $ps;
        $estudiante->genero = $request->genero;
        $estudiante->lateralidad = $request->lateralidad;
        $estudiante->direccion = $request->direccion;
        $estudiante->telefono = $request->telefono;
        $estudiante->email = $request->email;

        //  Udpdated Student's User
        $estudiante->user->name = "$request->nombre $request->apellido";
        $estudiante->user->user = $usuario;
        $estudiante->user->email = $request->email;

        //  Updated Father's Information of the Student
        $estudiante->tutor[0]->nombre = $request->nombre_padre;
        $estudiante->tutor[0]->dpi = $request->dpi_padre;
        $estudiante->tutor[0]->telefono = $request->telefono_padre;
        $estudiante->tutor[0]->direccion = $request->direccion_padre;
        $estudiante->tutor[0]->email = $request->email_padre;

        //  Updated Mother's Information of the Student
        $estudiante->tutor[1]->nombre = $request->nombre_madre;
        $estudiante->tutor[1]->dpi = $request->dpi_madre;
        $estudiante->tutor[1]->telefono = $request->telefono_madre;
        $estudiante->tutor[1]->direccion = $request->direccion_madre;
        $estudiante->tutor[1]->email = $request->email_madre;

        //  Updated Mother's Information of the Student
        $estudiante->tutor[2]->nombre = $request->nombre_tutor;
        $estudiante->tutor[2]->dpi = $request->dpi_tutor;
        $estudiante->tutor[2]->telefono = $request->telefono_tutor;
        $estudiante->tutor[2]->direccion = $request->direccion_tutor;
        $estudiante->tutor[2]->email = $request->email_tutor;

        //  Save Changes
        $estudiante->save();
        $estudiante->user->save();
        $estudiante->tutor[0]->save();
        $estudiante->tutor[1]->save();
        $estudiante->tutor[2]->save();

        DB::commit();

        return redirect()
            ->route('admin.estudiante.show', [$estudiante->id])
            ->with('process_result', [
                'status' => 'success',
                'content' => trans('forms-students.update_success')
            ])
        ;
    }

    public function destroy(Estudiante $estudiante)
    {
        //
    }

    /**
     * --------------------------------------------------------------------------
     *  Métodos para inscribir al estudiante
     * --------------------------------------------------------------------------
    **/

    public function inscripcion(Estudiante $estudiante)
    {
        $grados = Grados::where([
            ['nombre', '<>', 'Sin Grado'],
            ['cicloescolar_id', $this->academico_actual->cicloescolar_id]
        ])->get();

        $inscripcion_exist = GradoEstudiante::where([
            ['estudiante_id', $estudiante->id],
            ['cicloescolar_id', $this->academico_actual->cicloescolar_id]
        ])->first();

        if ( !$inscripcion_exist )
        {
            return view('admin.estudiantes.inscripcion', [
                'estudiante' => $estudiante,
                'grados' => $grados,
                'empresa' => $this->empresa,
            ]);
        }

        return abort('404');
    }

    public function confirmarinscripcion(Estudiante $estudiante, Grados $grado)
    {
        $inscripcion_exist = GradoEstudiante::where([
            ['estudiante_id', $estudiante->id],
            ['cicloescolar_id', $this->academico_actual->cicloescolar_id]
        ])->first();

        if ( !$inscripcion_exist )
        {
            return view('admin.estudiantes.confirmar_inscripcion', [
                'estudiante' => $estudiante,
                'grado' => $grado,
                'empresa' => $this->empresa,
                'academico_actual' => $this->academico_actual,
            ]);
        }

        return abort('404');
    }

    public function inscribir(Estudiante $estudiante, Grados $grado)
    {
        DB::beginTransaction();

        GradoEstudiante::create([
            'estudiante_id' => $estudiante->id,
            'grado_id' => $grado->id,
            'cicloescolar_id' => $this->academico_actual->cicloescolar_id,
        ]);

        DB::commit();

        return redirect()
            ->route('admin.estudiante.show', [$estudiante->id])
            ->with('process_result', [
                'status' => 'success',
                'content' => trans('forms-students.enroll_success')
            ])
        ;
    }

    /**
     * --------------------------------------------------------------------------
     *  Métodos para cambiar grado de estudianteS
     * --------------------------------------------------------------------------
    **/

    public function cambiargrado(Estudiante $estudiante)
    {
        $grados = Grados::where([['nombre', '<>', 'Sin Grado'], ['cicloescolar_id', $this->academico_actual->cicloescolar_id]])->get();

        $inscripcion_exist = GradoEstudiante::where([['estudiante_id', $estudiante->id], ['cicloescolar_id', $this->academico_actual->cicloescolar_id]])->first();

        if ( $inscripcion_exist )
        {
            return view('admin.estudiantes.grado', [
                'estudiante' => $estudiante,
                'grados' => $grados,
                'empresa' => $this->empresa,
            ]);
        }

        return abort('404');
    }

    public function confirmargrado(Estudiante $estudiante, Grados $grado)
    {
        $estudiante_cambio_grado = GradoEstudiante::where([['estudiante_id', $estudiante->id], ['cicloescolar_id', $this->academico_actual->cicloescolar_id]])->first();

        if ( $estudiante_cambio_grado )
        {
            if ($estudiante_cambio_grado->grado_id == $grado->id)
            {
                return back()->with('process_result', [
                    'status' => 'info',
                    'content' => trans('forms-students.selected_grade_error')
                ]);
            }
            else
            {
                return view('admin.estudiantes.confirmar_grado', [
                    'estudiante' => $estudiante,
                    'grado' => $grado,
                    'empresa' => $this->empresa,
                    'academico_actual' => $this->academico_actual,
                ]);
            }
        }

        return abort('404');
    }

    public function nuevogrado(Estudiante $estudiante, Grados $grado)
    {
        $estudiante_cambio_grado = GradoEstudiante::where([['estudiante_id', $estudiante->id], ['cicloescolar_id', $this->academico_actual->cicloescolar_id]])->first();

        if ($estudiante_cambio_grado)
        {
            DB::beginTransaction();

            $estudiante_cambio_grado->grado_id = $grado->id;
            $estudiante_cambio_grado->save();

            DB::commit();

            return redirect()
                ->route('admin.estudiante.show', [$estudiante->id])
                ->with('process_result', [
                    'status' => 'success',
                    'content' => trans('forms-students.update_success')
                ])
            ;
        }
        else
        {
            return 'Estudiante sin grado';
        }

        return abort('404');
    }
}

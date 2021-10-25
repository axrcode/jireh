<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Academico;
use App\Models\Empresa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $empresa;

    public function __construct()
    {
        //  Company Information
        $this->empresa = Empresa::where('nombre', env('EMPRESA_NAME'))->first();

        //  Permisos
        $this->middleware('can:admin/dashboard')->only('index');
    }

    public function index()
    {
        $total_estudiantes = 100;
        $total_colaboradores = 200;
        $total_inscripciones = 300;

        return view('admin.dashboard', [
            'total_estudiantes' => $total_estudiantes,
            'total_colaboradores' => $total_colaboradores,
            'total_inscripciones' => $total_inscripciones,
            'empresa' => $this->empresa,
        ]);
    }
}

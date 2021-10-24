<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
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
        $this->middleware('can:estudiante.dashboard')->only('index');
    }

    public function index()
    {
        return view('estudiante.dashboard', [
            'empresa' => $this->empresa
        ]);
    }
}

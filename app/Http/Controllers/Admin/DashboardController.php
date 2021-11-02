<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Academico;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Empresa;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $total_pedidos = Pedido::count();
        $total_clientes = Cliente::count();
        $total_empleados = Empleado::count();
        $total_entregados = Pedido::where('estado', 'Entregado')->count();
        $ultimos_pedidos = Pedido::latest()->take(10)->get();

        return view('admin.dashboard', [
            'total_pedidos' => $total_pedidos,
            'total_clientes' => $total_clientes,
            'total_empleados' => $total_empleados,
            'total_entregados' => $total_entregados,
            'ultimos_pedidos' => $ultimos_pedidos,
            'empresa' => $this->empresa,
        ]);
    }

    public function graphic()
    {
        $estados = Pedido::select('estado', DB::raw('COUNT(*) as total'))
            ->groupBy('estado')
            ->get();

        return response(json_encode($estados), 200)->header('Content-type', 'text/plain');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    private $empresa;
    public function __construct()
    {
        //  Company Information
        $this->empresa = Empresa::where('nombre', env('EMPRESA_NAME'))->first();

        //  Permisos
        $this->middleware('can:admin/clientes')->only('index');
        $this->middleware('can:admin/clientes/create')->only('create', 'store');
        $this->middleware('can:admin/clientes/show')->only('show');
        $this->middleware('can:admin/clientes/edit')->only('edit', 'update');
        $this->middleware('can:admin/clientes/delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();

        return view('admin.clientes.index', [
            'clientes' => $clientes,
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
        return view('admin.clientes.create', [
            'empresa' => $this->empresa
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
        $this->validate(request(), [
            'nombre' => 'required|string',
            'apellido' => 'required|string'
        ]);

        DB::beginTransaction();

        $cliente = new Cliente;
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->nit = $request->nit;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->save();

        DB::commit();

        return redirect()
        ->route('admin.clientes.index')
        ->with('process_result', [
            'status' => 'success',
            'content' => 'Nuevo cliente creado exitosamente'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return abort('404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('admin.clientes.edit', [
            'cliente' => $cliente,
            'empresa' => $this->empresa
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        DB::beginTransaction();

        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->nit = $request->nit;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->save();

        DB::commit();

        return redirect()
        ->route('admin.clientes.edit', [$cliente->id])
        ->with('process_result', [
            'status' => 'success',
            'content' => 'Cliente actualizado correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $pedidos_cliente = Pedido::where('cliente_id', $cliente->id)->get();

        if ( sizeof($pedidos_cliente) > 0 ) {

            if ( $cliente->estado == 'activo' ) {
                $cliente->estado = 'inactivo';
                $msg = 'El cliente ha sido inactivado ya que tiene pedidos asociados';
                $status = 'info';
            } else {
                $cliente->estado = 'activo';
                $msg = 'Cliente activado nuevamente';
                $status = 'success';
            }

            $cliente->save();

            return redirect()
            ->route('admin.clientes.index')
            ->with('process_result', [
                'status' => $status,
                'content' => $msg
            ]);
        } else {

            $cliente->delete();

            return redirect()
            ->route('admin.clientes.index')
            ->with('process_result', [
                'status' => 'success',
                'content' => 'Cliente eliminado correctamente'
            ]);
        }
    }
}

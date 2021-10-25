<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\DetallePedido;
use App\Models\Empresa;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
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
        $pedidos = Pedido::all();
        $clientes = Cliente::all();

        return view('admin.pedidos.index', [
            'pedidos' => $pedidos,
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        $pedido = new Pedido;
        $pedido->titulo = $request->titulo;
        $pedido->descripcion = $request->descripcion;
        $pedido->fecha_pedido = $request->fecha_pedido;
        $pedido->empleado_id = auth()->user()->id;
        $pedido->cliente_id = $request->cliente;
        $pedido->save();

        DB::commit();

        return redirect()->route('admin.pedidos.edit', [$pedido->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        $clientes = Cliente::all();

        $detalle_pedido = DetallePedido::where(['pedido_id' => $pedido->id])->get();

        return view('admin.pedidos.edit', [
            'pedido' => $pedido,
            'detalle_pedido' => $detalle_pedido,
            'clientes' => $clientes,
            'empresa' => $this->empresa
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        DB::beginTransaction();

        $pedido->titulo = $request->titulo;
        $pedido->descripcion = $request->descripcion;
        $pedido->fecha_pedido = $request->fecha_pedido;
        $pedido->cliente_id = $request->cliente;
        $pedido->save();

        DB::commit();

        return redirect()
        ->route('admin.pedidos.edit', [$pedido->id])
        ->with('process_result', [
            'status' => 'success',
            'content' => 'Pedido actualizado'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        //
    }

    /*
    |--------------------------------------------------------------------------
    | Metodos para Detalle Pedido
    |--------------------------------------------------------------------------
    */

    public function detalle_store(Request $request, Pedido $pedido)
    {
        DB::beginTransaction();

        $detalle_pedido = new DetallePedido;
        $detalle_pedido->pedido_id = $pedido->id;
        $detalle_pedido->talla = $request->talla;
        $detalle_pedido->cantidad = $request->cantidad;
        $detalle_pedido->descripcion = $request->descripcion;
        $detalle_pedido->save();

        DB::commit();

        return redirect()->route('admin.pedidos.edit', [$pedido->id]);
    }

    public function detalle_update(Request $request, Pedido $pedido, DetallePedido $detalle)
    {
        DB::beginTransaction();

        $detalle->talla = $request->talla;
        $detalle->cantidad = $request->cantidad;
        $detalle->descripcion = $request->descripcion;
        $detalle->save();

        DB::commit();

        return redirect()->route('admin.pedidos.edit', [$pedido->id]);
    }

    public function detalle_destroy(Pedido $pedido, DetallePedido $detalle)
    {
        DB::beginTransaction();
        $detalle->delete();
        DB::commit();

        return redirect()->route('admin.pedidos.edit', [$pedido->id]);
    }
}

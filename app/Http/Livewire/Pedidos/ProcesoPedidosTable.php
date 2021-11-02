<?php

namespace App\Http\Livewire\Pedidos;

use \Session;
use App\Models\Pedido;
use Livewire\Component;
use Livewire\WithPagination;

class ProcesoPedidosTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search, $fecha_inicio, $fecha_fin, $estado='Todos';

    public function render()
    {
        if ( $this->estado == 'Todos' && ( $this->fecha_inicio == '' && $this->fecha_fin == '' ) )
        {
            $pedidos = Pedido::join('clientes', 'clientes.id', '=', 'pedidos.cliente_id')
            ->where('clientes.nombre', 'LIKE', '%'.$this->search.'%')
            ->orWhere('clientes.apellido', 'LIKE', '%'.$this->search.'%')
            ->orWhere('pedidos.titulo', 'LIKE', '%'.$this->search.'%')
            ->orWhere('pedidos.descripcion', 'LIKE', '%'.$this->search.'%')
            ->orWhere('pedidos.estado', 'LIKE', '%'.$this->search.'%')
            ->select('clientes.nombre', 'clientes.apellido','pedidos.*')
            ->orderBy('pedidos.fecha_pedido', 'DESC')
            ->paginate(10);
        } else if ( $this->estado != 'Todos' && ( $this->fecha_inicio == '' && $this->fecha_fin == '' ) ) {
            $pedidos = Pedido::join('clientes', 'clientes.id', '=', 'pedidos.cliente_id')
            ->where('pedidos.estado', $this->estado)
            ->orderBy('pedidos.fecha_pedido', 'DESC')
            ->paginate(10);
        } else if ( $this->estado == 'Todos' && ( $this->fecha_inicio != '' || $this->fecha_fin != '' ) ) {

            if ( $this->fecha_fin == '' ) { $this->fecha_fin = date('Y-m-d');}

            $pedidos = Pedido::join('clientes', 'clientes.id', '=', 'pedidos.cliente_id')
            ->whereBetween('pedidos.fecha_pedido', [$this->fecha_inicio,  $this->fecha_fin])
            ->select('clientes.nombre', 'clientes.apellido','pedidos.*')
            ->orderBy('pedidos.fecha_pedido', 'DESC')
            ->paginate(10);
        } else if ( $this->estado != 'Todos' && ( $this->fecha_inicio != '' || $this->fecha_fin != '' ) ) {
            $pedidos = Pedido::join('clientes', 'clientes.id', '=', 'pedidos.cliente_id')
            ->where('pedidos.estado', $this->estado)
            ->whereBetween('pedidos.fecha_pedido', [$this->fecha_inicio,  $this->fecha_fin])
            ->select('clientes.nombre', 'clientes.apellido','pedidos.*')
            ->orderBy('pedidos.fecha_pedido', 'DESC')
            ->paginate(10);

        }

        return view('livewire.pedidos.proceso-pedidos-table', [
            'pedidos' => $pedidos,
        ]);
    }

    public function updatedsearch($search)
    {
        $this->fecha_inicio = '';
        $this->fecha_fin = '';
        $this->estado = 'Todos';
    }

    public function updatedestado($estado)
    {
        $this->search = '';
    }

    public function limpiar()
    {
        $this->fecha_inicio = '';
        $this->fecha_fin = '';
        $this->estado = 'Todos';
        $this->search = '';
    }

    public function despachado($pedido_id)
    {
        $pedido = Pedido::find($pedido_id);

        if ( $pedido->estado == 'Solicitado' ) {
            $pedido->fecha_despachado = date('Y-m-d');
            $pedido->estado = 'Despachado';
            $pedido->update();

            $this->emit('msg-ok', 'Estado del pedido cambiado a "Despachado"');
        } else if ( $pedido->estado == 'Despachado' ) {
            $pedido->fecha_despachado = '';
            $pedido->estado = 'Solicitado';
            $pedido->update();

            $this->emit('msg-ok', 'Estado del pedido cambiado a "Solicitado"');
        } else {
            $this->emit('msg-info', 'Verifique con el departamento involucrado');
            $this->emit('msg-error', 'No se puede cambiar el estado a "Despachado" debido a que su estado actual es '.$pedido->estado);
        }
    }

    public function enProceso($pedido_id)
    {
        $pedido = Pedido::find($pedido_id);

        if ( $pedido->estado == 'Despachado' ) {

            $pedido->fecha_proceso = date('Y-m-d');
            $pedido->estado = 'En Proceso';
            $pedido->update();

            $this->emit('msg-ok', 'Estado del pedido cambiado a "En Proceso"');
        } else if ( $pedido->estado == 'En Proceso' ) {
            $pedido->fecha_proceso = '';
            $pedido->estado = 'Despachado';
            $pedido->update();

            $this->emit('msg-ok', 'Estado del pedido cambiado a "Despachado"');
        } else {
            $this->emit('msg-info', 'Verifique con el departamento involucrado');
            $this->emit('msg-error', 'No se puede cambiar el estado a "En Proceso" debido a que su estado actual es '.$pedido->estado);
        }
    }

    public function terminado($pedido_id)
    {
        $pedido = Pedido::find($pedido_id);

        if ( $pedido->estado == 'En Proceso' ) {

            $pedido->fecha_terminado = date('Y-m-d');
            $pedido->estado = 'Terminado';
            $pedido->update();

            $this->emit('msg-ok', 'Estado del pedido cambiado a "Terminado"');
        } else if ( $pedido->estado == 'Terminado' ) {
            $pedido->fecha_terminado = '';
            $pedido->estado = 'En Proceso';
            $pedido->update();

            $this->emit('msg-ok', 'Estado del pedido cambiado a "En Proceso"');
        } else {
            $this->emit('msg-info', 'Verifique con el departamento involucrado');
            $this->emit('msg-error', 'No se puede cambiar el estado a "Terminado" debido a que su estado actual es '.$pedido->estado);
        }
    }

    public function entregado($pedido_id)
    {
        $pedido = Pedido::find($pedido_id);

        if ( $pedido->estado == 'Terminado' ) {

            $pedido->fecha_entregado = date('Y-m-d');
            $pedido->estado = 'Entregado';
            $pedido->update();

            $this->emit('msg-ok', 'Estado del pedido cambiado a "Entregado"');
        } else if ( $pedido->estado == 'Entregado' ) {
            $pedido->fecha_entregado = '';
            $pedido->estado = 'Terminado';
            $pedido->update();

            $this->emit('msg-ok', 'Estado del pedido cambiado a "Terminado"');
        } else {
            $this->emit('msg-info', 'Verifique con el departamento involucrado');
            $this->emit('msg-error', 'No se puede cambiar el estado a "Entregado" debido a que su estado actual es '.$pedido->estado);
        }
    }
}

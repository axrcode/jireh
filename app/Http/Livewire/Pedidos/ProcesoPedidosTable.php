<?php

namespace App\Http\Livewire\Pedidos;

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
}

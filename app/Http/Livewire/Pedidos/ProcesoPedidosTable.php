<?php

namespace App\Http\Livewire\Pedidos;

use App\Models\Pedido;
use Livewire\Component;
use Livewire\WithPagination;

class ProcesoPedidosTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search, $fecha_inicio, $fecha_fin, $estado;

    public function render()
    {
        $pedidos = Pedido::join('clientes', 'clientes.id', '=', 'pedidos.cliente_id')
            ->where('clientes.nombre', 'LIKE', '%'.$this->search.'%')
            ->orWhere('clientes.apellido', 'LIKE', '%'.$this->search.'%')
            ->orWhere('pedidos.titulo', 'LIKE', '%'.$this->search.'%')
            ->orWhere('pedidos.descripcion', 'LIKE', '%'.$this->search.'%')
            ->orWhere('pedidos.estado', 'LIKE', '%'.$this->search.'%')
            ->select('clientes.nombre', 'clientes.apellido','pedidos.*')
            ->paginate(2);

        return view('livewire.pedidos.proceso-pedidos-table', [
            'pedidos' => $pedidos,
        ]);
    }
}

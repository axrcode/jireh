@extends('layouts.app')

@section('head')

    <title>Editar Pedido - {{ config('app.name', 'Sistema') }}</title>

@endsection

@section('content')

<div class="wrapper">

    <!--    Navbar    -->
    @include('layouts.navbar')

    <!--    Main Sidebar Container    -->
    @include('layouts.drawer')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper text-sm">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12">
                        <h1 class="font-weight-bold m-0">
                            <i class="fas fa-cart-arrow-down mr-1"></i>
                            Editar Pedido
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">

                    <div class="col-12">
                        <div class="card shadow-none">
                            <div class="card-body">

                                <form action="{{ route('admin.pedidos.store') }}" method="POST">
                                    @csrf

                                    <div class="row">

                                        <div class="col-12">
                                            <h4 class="font-weight-bold">Información del Pedido</h4>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cliente">Cliente</label>
                                                <select
                                                    class="form-control select2bs4"
                                                    name="cliente"
                                                    id="cliente"
                                                    required>
                                                    @foreach ($clientes as $cliente)
                                                        <option
                                                            value="{{ $cliente->id }}"
                                                            {{ $cliente->id == $pedido->cliente_id ? 'selected' : '' }}>
                                                            {{ $cliente->nombre }} {{ $cliente->apellido }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="titulo">Título del Pedido</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="titulo"
                                                    name="titulo"
                                                    value="{{ $pedido->titulo }}"
                                                    autocomplete="off"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="fecha_pedido">Fecha Pedido</label>
                                                <input
                                                    type="date"
                                                    class="form-control"
                                                    id="fecha_pedido"
                                                    name="fecha_pedido"
                                                    value="{{ $pedido->fecha_pedido }}"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="descripcion">Descripción del Pedido</label>
                                                <textarea
                                                    class="form-control"
                                                    name="descripcion"
                                                    id="descripcion"
                                                    autocomplete="off"
                                                    rows="2"
                                                >{{ $pedido->descripcion }}</textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <button type="submit" class="btn btn-primary btn-flat btn-sm px-3">Guardar</button>

                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card shadow-none">
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-10">
                                        <h4 class="font-weight-bold">Detalle del Pedido</h4>
                                    </div>

                                    <div class="col-2">
                                        <button type="button" class="btn btn-primary btn-block btn-flat btn-sm"
                                            data-toggle="modal" data-target="#modalCrearDetalle">
                                            <i class="fas fa-plus-square mr-2"></i>
                                            Nuevo Detalle
                                        </button>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <table id="principal" class="table hover-table display nowrap" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th style="width: 20%">
                                                        Talla
                                                    </th>
                                                    <th style="width: 20%">
                                                        Cantidad
                                                    </th>
                                                    <th style="width: 50%">
                                                        Descripción
                                                    </th>
                                                    <th style="width: 10%">
                                                        {{ __('Actions') }}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($detalle_pedido as $item)
                                                    <tr>
                                                        <td>{{ $item->talla }}</td>
                                                        <td>{{ $item->cantidad }}</td>
                                                        <td>{{ $item->descripcion }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-secondary btn-flat btn-sm"
                                                                data-toggle="modal" data-target="#modalEditarDetalle_{{ $item->id }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>

                                                            <!-- Modal Editar Detalle Pedido -->
                                                            <div class="modal fade" id="modalEditarDetalle_{{ $item->id }}" tabindex="-1" aria-labelledby="modalEditarDetalle_{{ $item->id }}" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <form action="{{ route('admin.pedidos.detalle.update', [$pedido->id, $item->id]) }}" method="POST">
                                                                            @csrf
                                                                            @method('PUT')

                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Editar Detalle del Pedido</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row">

                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="talla">Talla</label>
                                                                                            <input
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                id="talla"
                                                                                                name="talla"
                                                                                                value="{{ $item->talla }}"
                                                                                                autocomplete="off"
                                                                                                required>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="cantidad">Cantidad</label>
                                                                                            <input
                                                                                                type="number"
                                                                                                class="form-control"
                                                                                                id="cantidad"
                                                                                                name="cantidad"
                                                                                                value="{{ $item->cantidad }}"
                                                                                                autocomplete="off"
                                                                                                required>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-12">
                                                                                        <div class="form-group">
                                                                                            <label for="descripcion">Descripción del Pedido</label>
                                                                                            <textarea
                                                                                                class="form-control"
                                                                                                name="descripcion"
                                                                                                id="descripcion"
                                                                                                autocomplete="off"
                                                                                                rows="2"
                                                                                            >{{ $item->descripcion }}</textarea>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary btn-flat px-3" data-dismiss="modal">Cancelar</button>
                                                                                <button type="submit" class="btn btn-primary btn-flat px-3">Guardar</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <button type="button" class="btn btn-danger btn-flat btn-sm"
                                                                data-toggle="modal" data-target="#modalEliminarDetalle_{{ $item->id }}">
                                                                <i class="fas fa-trash"></i>
                                                            </button>

                                                            <!-- Modal Eliminar Detalle Pedido -->
                                                            {{-- <div class="modal fade" id="modalEliminarDetalle_{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <form action="{{ route('admin.pedidos.detalle.store', [$pedido->id]) }}" method="POST">
                                                                            @csrf
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Editar Detalle del Pedido</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                ¿ Está seguro que quiere eliminar el detalle
                                                                                <span class="font-weight-bold">
                                                                                    {{ $item->talla }} - {{ $item->cantidad }}
                                                                                </span>
                                                                                ?
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary btn-flat px-3" data-dismiss="modal">Cancelar</button>
                                                                                <button type="submit" class="btn btn-primary btn-flat px-3">Guardar</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>

    <!-- Modal Crear Detalle Pedido -->
    <div class="modal fade" id="modalCrearDetalle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.pedidos.detalle.store', [$pedido->id]) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear Nuevo Detalle del Pedido</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="talla">Talla</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="talla"
                                        name="talla".
                                        autocomplete="off"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cantidad">Cantidad</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="cantidad"
                                        name="cantidad".
                                        autocomplete="off"
                                        required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripción del Pedido</label>
                                    <textarea
                                        class="form-control"
                                        name="descripcion"
                                        id="descripcion"
                                        autocomplete="off"
                                        rows="2"
                                    ></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-flat px-3" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-flat px-3">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Control Sidebar -->
    @include('layouts.aside')

    <!-- Main Footer -->
    @include('layouts.footer')

</div>

@endsection

@section('scripts')

    @include('extensions.toast-process-result')

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>

@endsection

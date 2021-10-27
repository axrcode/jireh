@extends('layouts.app')

@section('head')

    <title>Pedidos - {{ config('app.name', 'Sistema') }}</title>

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
                            Pedidos
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

                                <div class="row">

                                        <div class="col-md-4">
                                            <button type="button"
                                                class="btn btn-primary btn-sm btn-flat px-3" data-toggle="modal" data-target="#modalCrearPedido">
                                                <i class="fas fa-plus-square mr-2"></i>
                                                Crear nuevo pedido
                                            </button>
                                        </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card shadow-none">

                            <div class="card-body px-3">

                                <table id="principal" class="table hover-table display nowrap" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width: 30%">
                                                Título del Pedido
                                            </th>
                                            <th style="width: 15%">
                                                Cliente
                                            </th>
                                            <th style="width: 20%">
                                                Fecha del Pedido
                                            </th>
                                            <th style="width: 15%">
                                                Empleado Asignado
                                            </th>
                                            <th style="width: 10%">
                                                Estado del Pedido
                                            </th>
                                            <th style="width: 10%">
                                                {{ __('Actions') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($pedidos as $pedido)
                                            <tr class="item">
                                                <td class="bg-light">

                                                        <a  href="{{ route('admin.pedidos.show', [$pedido->id]) }}"
                                                            class="text-dark font-weight-bold text-wrap">
                                                            {{ $pedido->titulo }}
                                                        </a>

                                                </td>
                                                <td class="text-center text-md-left">
                                                    {{ $pedido->cliente->nombre }} {{ $pedido->cliente->apellido }}
                                                </td>
                                                <td>
                                                    {{ $pedido->fecha_pedido }}
                                                </td>
                                                <td>
                                                    {{ $pedido->empleado->nombre }} {{ $pedido->empleado->apellido }}
                                                </td>
                                                <td>
                                                    <span class="text-capitalize badge
                                                        @if ( $pedido->estado == 'pendiente' )
                                                            badge-danger
                                                        @elseif ( $pedido->estado == 'proceso' )
                                                            badge-warning
                                                        @elseif ( $pedido->estado == 'entregado' )
                                                            badge-success
                                                        @endif">
                                                        {{ $pedido->estado }}
                                                    </span>

                                                </td>
                                                <td class="text-right">

                                                        <a  href="{{ route('admin.pedidos.show', [$pedido->id]) }}"
                                                            class="btn btn-success btn-sm btn-flat"
                                                            data-toggle="tooltip" data-placement="top" title="Ver Informacion Grado"
                                                        >
                                                            <i class="fas fa-id-card"></i>
                                                        </a>

                                                        <a  href="{{ route('admin.pedidos.edit', [$pedido->id]) }}"
                                                            class="btn btn-primary btn-sm btn-flat"
                                                            data-toggle="tooltip" data-placement="top" title="Ver Informacion Grado"
                                                        >
                                                            <i class="fas fa-edit"></i>
                                                        </a>

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

    <!-- Modal Crear Pedido -->
    <div class="modal fade" id="modalCrearPedido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('admin.pedidos.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear Nuevo Pedido</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="cliente">Cliente</label>
                                    <select
                                        class="form-control select2bs4"
                                        name="cliente"
                                        id="cliente"
                                        required>
                                        @foreach ($clientes as $cliente)
                                            <option
                                                value="{{ $cliente->id }}">
                                                {{ $cliente->nombre }} {{ $cliente->apellido }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="titulo">Título del Pedido</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="titulo"
                                        name="titulo".
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
                                        rows="3"
                                    ></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha_pedido">Fecha Pedido</label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        id="fecha_pedido"
                                        name="fecha_pedido"
                                        value="{{ date('Y-m-d') }}"
                                        required>
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

    <script src="{{ secure_asset('scripts/principal-datatable.js') }}"></script>

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

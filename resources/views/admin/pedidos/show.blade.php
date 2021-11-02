@extends('layouts.app')

@section('head')

    <title>Pedido - {{ config('app.name', 'Sistema') }}</title>

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
                            Pedido
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
                        <div class="invoice p-5 mb-3" id="contenidoPedido">

                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <img
                                            src="{{ $empresa->logo }}"
                                            alt="AdminLTE Logo"
                                            class="img-size-100"
                                        >

                                        <small class="float-right">
                                            <b>Fecha y Hora:</b>
                                            {{ date('d-m-Y') }}
                                        </small>
                                    </h4>
                                </div>
                            </div>

                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    Cliente
                                    <address>
                                        <strong>
                                            {{ $pedido->cliente->nombre }} {{ $pedido->cliente->apellido }}
                                        </strong><br>
                                        {{ $pedido->cliente->nit }}<br>
                                        {{ $pedido->cliente->direccion }}<br>
                                    </address>
                                </div>

                                <div class="col-sm-4 invoice-col">
                                    Vendedor
                                    <address>
                                        <strong>
                                            {{ $pedido->empleado->nombre }} {{ $pedido->empleado->apellido }}
                                        </strong><br>
                                        {{ $pedido->empleado->cargo }}<br>
                                        {{ $pedido->empleado->departamento->nombre }}
                                    </address>
                                </div>

                                <div class="col-sm-4 invoice-col">
                                    <b>Pedido</b> #{{ $pedido->correlative }}<br>
                                    <b>Fecha Pedido:</b> {{ $pedido->fecha_pedido }}<br>
                                    <b>Fecha Entrega:</b> {{ $pedido->fecha_entrega == null ? 'No entregado' : $pedido->fecha_entrega }}<br>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h4 class="font-weight-bold mt-2">{{ $pedido->titulo }}</h4>
                                </div>
                                <div class="col-12">
                                    <h5 class="mb-3">{{ $pedido->descripcion }}</h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width:20%">Categoría</th>
                                                <th style="width:20%">Talla</th>
                                                <th style="width:20%">Cantidad</th>
                                                <th style="width:40%">Descripcion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pedido->detallePedido as $item)
                                                <tr>
                                                    <td>{{ $item->tipo }}</td>
                                                    <td>{{ $item->talla }}</td>
                                                    <td>{{ $item->cantidad }}</td>
                                                    <td>{{ $item->descripcion }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row no-print">
                                <div class="col-12 mt-3">
                                  <button type="button" class="btn btn-primary btn-flat btn-sm px-4"
                                    onclick="window.print()">
                                      <i class="fas fa-print"></i>
                                      Print
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

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

    <script src="{{ asset('scripts/principal-datatable.js') }}"></script>

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

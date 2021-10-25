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
                                            <a  href="{{ route('admin.grado.create') }}"
                                                class="btn btn-success btn-sm btn-flat px-3">
                                                <i class="fas fa-plus-square mr-2"></i>
                                                Crear nuevo pedido
                                            </a>
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
                                                            class="btn btn-success btn-sm btn-flat px-3"
                                                            data-toggle="tooltip" data-placement="top" title="Ver Informacion Grado"
                                                        >
                                                            <i class="fas fa-id-card mr-2"></i>
                                                            {{ __('Card') }}
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

    <!-- Control Sidebar -->
    @include('layouts.aside')

    <!-- Main Footer -->
    @include('layouts.footer')

</div>

@endsection

@section('scripts')

    <script src="{{ asset('scripts/principal-datatable.js') }}"></script>

    @include('extensions.toast-process-result')

@endsection

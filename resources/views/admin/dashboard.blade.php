@extends('layouts.app')

@section('head')

    <title>{{ __('Dashboard') }} - {{ config('app.name', 'Sistema') }}</title>

@endsection

@section('content')

<div class="wrapper">

    <!--    Navbar    -->
    @include('layouts.navbar')

    <!--    Main Sidebar Container    -->
    @include('layouts.drawer')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper text-sm">

        <!-- Preloader -->
        {{-- <div class="dark-mode">
            <div class="preloader flex-column justify-content-center align-items-center">
                <img
                    class="animation__wobble"
                    src="{{ $empresa->logo }}"
                    alt="AdminLTELogo"
                    height="150" width="200"
                >
            </div>
        </div> --}}

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="font-weight-bold m-0">
                            <i class="fas fa-tachometer-alt mr-1"></i>
                            {{ __('Dashboard') }}
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Starter Page</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">

                    <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                        <a href="{{ route('admin.pedidos.index') }}" class="text-decoration-none">
                            <div class="small-box bg-gradient-primary">
                                <div class="inner">
                                    <h3>{{ $total_pedidos }}</h3>
                                    <p>Pedidos</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-cart-arrow-down"></i>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                        <a href="{{ route('admin.clientes.index') }}" class="text-decoration-none">
                            <div class="small-box bg-gradient-teal">
                                <div class="inner">
                                    <h3>{{ $total_clientes }}</h3>
                                    <p>Clientes</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                        <a href="{{ route('admin.empleados.index') }}" class="text-decoration-none">
                            <div class="small-box bg-gradient-gray">
                                <div class="inner">
                                    <h3>{{ $total_empleados }}</h3>
                                    <p>Empleados</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                        <a href="{{ route('admin.procesos.index') }}" class="text-decoration-none">
                            <div class="small-box bg-gradient-lightblue">
                                <div class="inner">
                                    <h3>{{ $total_entregados }}</h3>
                                    <p>Entregados</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>

                <div class="row">

                    <div class="col-12 col-md-8">
                        <div class="card shadow-none">
                            <div class="card-header bg-white border-transparent pt-3 pb-0">
                                <h1 class="card-title font-weight-bold">
                                    Últimos Pedidos Registrados
                                </h1>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th style="width: 30%">
                                                    Pedido
                                                </th>
                                                <th style="width: 20%">
                                                    Cliente
                                                </th>
                                                <th style="width: 20%">
                                                    Fecha
                                                </th>
                                                <th style="width: 20%">
                                                    Estado
                                                </th>
                                                <th style="width: 10%">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ultimos_pedidos as $pedido)
                                                <tr>
                                                    <td>
                                                        {{ $pedido->titulo }}
                                                    </td>
                                                    <td>
                                                        {{ $pedido->cliente->nombre }} {{ $pedido->cliente->apellido }}
                                                    </td>
                                                    <td>
                                                        {{ date('d/m/Y', strtotime($pedido->fecha_pedido)) }}
                                                    </td>
                                                    <td class="font-weight-bold">
                                                        {{ $pedido->estado }}
                                                    </td>
                                                    <td>
                                                        <a  href="{{ route('admin.pedidos.show', $pedido->id) }}"
                                                            class="btn btn-block btn-primary btn-flat btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer bg-white clearfix">
                                <a  href="{{ route('admin.pedidos.index') }}"
                                    class="btn btn-xs btn-light border float-right py-1 px-4">
                                    Ver todos los pedidos
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="card shadow-none">
                            <div class="card-header bg-white border-transparent pt-3 pb-0">
                                <h3 class="card-title font-weight-bold">
                                    Distribución de Estudiantes
                                </h3>
                            </div>
                            <div class="card-body">
                                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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

    <script src="{{ asset('scripts/grafica-dashboard.js') }}"></script>

@endsection

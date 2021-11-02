@extends('layouts.app')

@section('head')

    <title>Reporte Pedidos - {{ config('app.name', 'Sistema') }}</title>

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
                            <i class="fas fa-chart-bar mr-1"></i>
                            Reporte Pedidos
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
                                            <th style="width: 10%">
                                                No.
                                            </th>
                                            <th style="width: 25%">
                                                Pedido
                                            </th>
                                            </th>
                                            <th style="width: 20%">
                                                Cliente
                                            </th>
                                            <th style="width: 15%">
                                                Fecha Solicitado
                                            </th>
                                            <th style="width: 15%">
                                                Fecha Entregado
                                            </th>
                                            <th style="width: 15%">
                                                Estado
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $contador = 1 @endphp
                                        @foreach ($pedidos as $pedido)
                                            <tr class="item">
                                                <td>
                                                    {{ $contador++ }}
                                                </td>
                                                <td class="bg-light">
                                                    <span class="text-dark font-weight-bold text-wrap">
                                                        {{ $pedido->titulo }}
                                                    </span>
                                                </td>
                                                <td class="bg-light">
                                                    <span class="text-dark text-wrap">
                                                        {{ $pedido->cliente->nombre }} {{ $pedido->cliente->apellido }}
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ date('d/m/Y', strtotime($pedido->fecha_pedido)) }}
                                                </td>
                                                <td>
                                                    @if ($pedido->fecha_entregado == null)
                                                    <span class="text-capitalize badge badge-secondary">
                                                        Pendiente de entregar
                                                    </span>
                                                    @else
                                                        {{ date('d/m/Y', strtotime($pedido->fecha_entregado)) }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="text-capitalize badge
                                                        @if ( $pedido->estado == 'Solicitado' )
                                                            bg-danger
                                                        @elseif ( $pedido->estado == 'Despachado' )
                                                            bg-orange
                                                        @elseif ( $pedido->estado == 'En Proceso' )
                                                            bg-warning
                                                        @elseif ( $pedido->estado == 'Terminado' )
                                                            bg-success
                                                        @else
                                                            bg-primary
                                                        @endif">
                                                        {{ $pedido->estado }}
                                                    </span>
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

    <script src="{{ asset('scripts/report-datatable.js') }}"></script>

    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

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

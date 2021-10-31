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
                            <i class="fas fa-users mr-1"></i>
                            Clientes
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
                                            <a  href="{{ route('admin.clientes.create') }}"
                                                class="btn btn-primary btn-sm btn-flat px-3">
                                                <i class="fas fa-plus-square mr-2"></i>
                                                Crear nuevo cliente
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
                                            <th style="width: 5%">
                                                No.
                                            </th>
                                            <th style="width: 30%">
                                                Nombre
                                            </th>
                                            <th style="width: 15%">
                                                Nit
                                            </th>
                                            <th style="width: 15%">
                                                Teléfono
                                            </th>
                                            <th style="width: 25%">
                                                Dirección
                                            </th>
                                            <th style="width: 10%">
                                                {{ __('Actions') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $contador = 1 @endphp
                                        @foreach ($clientes as $cliente)
                                            <tr class="item">
                                                <td>
                                                    {{ $contador++ }}
                                                </td>
                                                <td class="bg-light">

                                                        <a  href="{{ route('admin.clientes.show', [$cliente->id]) }}"
                                                            class="text-dark font-weight-bold text-wrap">
                                                            {{ $cliente->nombre }} {{ $cliente->apellido }}
                                                        </a>

                                                </td>
                                                <td class="text-center text-md-left">
                                                    {{ $cliente->nit }}
                                                </td>
                                                <td>
                                                    {{ $cliente->telefono }}
                                                </td>
                                                <td>
                                                    {{ $cliente->direccion }}
                                                </td>
                                                <td class="text-right">

                                                        <a  href="{{ route('admin.clientes.show', [$cliente->id]) }}"
                                                            class="btn btn-success btn-sm btn-flat"
                                                            data-toggle="tooltip" data-placement="top" title="Ver Informacion Grado"
                                                        >
                                                            <i class="fas fa-id-card"></i>
                                                        </a>

                                                        <a  href="{{ route('admin.clientes.edit', [$cliente->id]) }}"
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

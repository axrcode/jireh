@extends('layouts.app')

@section('head')

    <title>Empleados - {{ config('app.name', 'Sistema') }}</title>

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
                            <i class="fas fa-user mr-1"></i>
                            Empleados
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
                                            <a  href="{{ route('admin.empleados.create') }}"
                                                class="btn btn-primary btn-sm btn-flat px-3">
                                                <i class="fas fa-plus-square mr-2"></i>
                                                Crear nuevo empleado
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
                                            <th style="width: 20%">
                                                Nombre
                                            </th>
                                            <th style="width: 15%">
                                                Cargo
                                            </th>
                                            <th style="width: 20%">
                                                Departamento
                                            </th>
                                            <th style="width: 10%">
                                                Teléfono
                                            </th>
                                            <th style="width: 15%">
                                                Email
                                            </th>
                                            <th style="width: 5%">
                                                Estado
                                            </th>
                                            <th style="width: 10%">
                                                {{ __('Actions') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $contador = 1 @endphp
                                        @foreach ($empleados as $empleado)
                                            <tr class="item">
                                                <td>
                                                    {{ $contador++ }}
                                                </td>
                                                <td class="bg-light">

                                                        <a  href="{{ route('admin.clientes.edit', [$empleado->id]) }}"
                                                            class="text-dark font-weight-bold text-wrap">
                                                            {{ $empleado->nombre }} {{ $empleado->apellido }}
                                                        </a>

                                                </td>
                                                <td class="text-center text-md-left">
                                                    {{ $empleado->cargo }}
                                                </td>
                                                <td>
                                                    {{ $empleado->departamento->nombre }}
                                                </td>
                                                <td>
                                                    {{ $empleado->telefono }}
                                                </td>
                                                <td>
                                                    {{ $empleado->user->email }}
                                                </td>
                                                <td>
                                                    @if ($empleado->estado == 'activo')
                                                        <span class="badge badge-success">
                                                            {{ $empleado->estado }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-danger">
                                                            {{ $empleado->estado }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-right">

                                                        <a  href="{{ route('admin.empleados.edit', [$empleado->id]) }}"
                                                            class="btn btn-success btn-sm btn-flat"
                                                            >
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <button type="button" data-toggle="modal" data-target="#modalEliminarCliente_{{ $empleado->id }}"
                                                            class="btn @if ($empleado->estado=='inactivo') btn-primary @else btn-danger @endif btn-sm btn-flat"
                                                        >
                                                            <i class="fas @if ($empleado->estado=='inactivo') fa-check-circle @else fa-trash @endif"></i>
                                                        </button>

                                                        <!-- Modal Eliminar Cliente -->
                                                        <div class="modal fade" id="modalEliminarCliente_{{ $empleado->id }}" tabindex="-1" aria-labelledby="modalEliminarCliente_{{ $empleado->id }}" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form action="{{ route('admin.empleados.destroy', [$empleado->id]) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                                @if ($empleado->estado=='inactivo') Activar @else Eliminar @endif
                                                                                Cliente
                                                                            </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body text-left text-wrap">
                                                                            ¿ Está seguro que desea
                                                                            @if ($empleado->estado=='inactivo') activar @else eliminar @endif
                                                                            al empleado
                                                                            <b>{{ $empleado->nombre }} {{ $empleado->apellido }}</b> ?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary btn-flat px-3" data-dismiss="modal">Cancelar</button>
                                                                            <button type="submit" class="btn btn-danger btn-flat px-3">Confirmar</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

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

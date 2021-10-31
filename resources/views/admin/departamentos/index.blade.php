@extends('layouts.app')

@section('head')

    <title>Departamentos - {{ config('app.name', 'Sistema') }}</title>

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
                            <i class="fas fa-sitemap mr-1"></i>
                            Departamentos
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
                                                class="btn btn-primary btn-sm btn-flat px-3" data-toggle="modal" data-target="#modalCrearDepto">
                                                <i class="fas fa-plus-square mr-2"></i>
                                                Crear nuevo departamento
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
                                            <th style="width: 10%">
                                                No.
                                            </th>
                                            <th style="width: 60%">
                                                Nombre de Departamento
                                            </th>
                                            <th style="width: 20%">
                                                Estado
                                            </th>
                                            <th style="width: 10%">
                                                {{ __('Actions') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $contador = 1 @endphp
                                        @foreach ($departamentos as $depto)
                                            <tr class="item">
                                                <td>
                                                    {{ $contador++ }}
                                                </td>
                                                <td class="bg-light">
                                                    <span class="text-dark font-weight-bold text-wrap">
                                                        {{ $depto->nombre }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="text-capitalize badge
                                                        @if ( $depto->estado == 'activo' )
                                                            badge-success
                                                        @else
                                                            badge-danger
                                                        @endif">
                                                        {{ $depto->estado }}
                                                    </span>

                                                </td>
                                                <td class="text-right">

                                                    <button type="button" data-toggle="modal" data-target="#modalActualizarDepto_{{ $depto->id }}"
                                                        class="btn btn-success btn-sm btn-flat"
                                                    >
                                                        <i class="fas fa-edit"></i>
                                                    </button>

                                                    <!-- Modal Actualizar Departamentos -->
                                                    <div class="modal fade" id="modalActualizarDepto_{{ $depto->id }}" tabindex="-1" aria-labelledby="modalActualizarDepto_{{ $depto->id }}" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action="{{ route('admin.departamentos.update', [$depto->id]) }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Departamento</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body text-left">
                                                                        <div class="row">

                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label for="nombre">Nombre del Departamento</label>
                                                                                    <input
                                                                                        type="text"
                                                                                        class="form-control"
                                                                                        id="nombre"
                                                                                        name="nombre"
                                                                                        autocomplete="off"
                                                                                        value="{{ $depto->nombre }}"
                                                                                        required>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary btn-flat px-3" data-dismiss="modal">Cancelar</button>
                                                                        <button type="submit" class="btn btn-success btn-flat px-3">Confirmar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="button" data-toggle="modal" data-target="#modalEliminarDepto_{{ $depto->id }}"
                                                        class="btn @if ($depto->estado=='inactivo') btn-primary @else btn-danger @endif btn-sm btn-flat"
                                                    >
                                                        <i class="fas @if ($depto->estado=='inactivo') fa-check-circle @else fa-trash @endif"></i>
                                                    </button>

                                                    <!-- Modal Eliminar Departamentos -->
                                                    <div class="modal fade" id="modalEliminarDepto_{{ $depto->id }}" tabindex="-1" aria-labelledby="modalEliminarDepto_{{ $depto->id }}" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action="{{ route('admin.departamentos.destroy', [$depto->id]) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            @if ($depto->estado=='inactivo') Activar @else Eliminar @endif
                                                                            Departamento
                                                                        </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body text-left text-wrap">
                                                                        ¿ Está seguro que desea
                                                                        @if ($depto->estado=='inactivo') activar @else eliminar @endif
                                                                        el departamento
                                                                        <b>{{ $depto->nombre }}</b>?
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

    <!-- Modal Crear Pedido -->
    <div class="modal fade" id="modalCrearDepto" tabindex="-1" aria-labelledby="modalCrearDepto" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.departamentos.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear Nuevo Departamento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nombre">Nombre del Departamento</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="nombre"
                                        name="nombre"
                                        autocomplete="off"
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

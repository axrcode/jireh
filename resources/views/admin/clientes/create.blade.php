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
                            <i class="fas fa-users mr-1"></i>
                            Crear Nuevo Cliente
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <form action="{{ route('admin.clientes.store') }}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-12">
                            <div class="card shadow-none">
                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 mb-3">
                                            <h4 class="font-weight-bold">Información del Cliente</h4>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="nombre"
                                                    name="nombre"
                                                    placeholder="Nombre del cliente"
                                                    autocomplete="off"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="apellido">Apellido</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="apellido"
                                                    name="apellido"
                                                    placeholder="Apellido del cliente"
                                                    autocomplete="off"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nit">Nit</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="nit"
                                                    name="nit"
                                                    placeholder="Nit del cliente"
                                                    autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="telefono">Teléfono</label>
                                                <input
                                                    type="number"
                                                    class="form-control"
                                                    id="telefono"
                                                    name="telefono"
                                                    placeholder="Número de teléfono del cliente"
                                                    autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="direccion">Dirección</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="direccion"
                                                    name="direccion"
                                                    placeholder="Dirección del cliente"
                                                    autocomplete="off">
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 offset-md-8">
                            <div class="row">
                                <div class="col-6 pl-md-0">
                                    <a  href="{{ route('admin.clientes.index') }}"
                                        class="btn btn-secondary btn-sm btn-flat btn-block">
                                        Regresar
                                    </a>
                                </div>
                                <div class="col-6 pl-md-0">
                                    <button type="submit"
                                        class="btn btn-success btn-sm btn-flat btn-block">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal Eliminar Pedido -->
    {{-- <div class="modal fade" id="modalEliminarPedido" tabindex="-1" aria-labelledby="modalEliminarPedido" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.pedidos.destroy', [$pedido->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Pedido</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿ Está seguro que desea eliminar el pedido ? <br>
                        <b>Se borrará toda la información relacionada a él</b>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-flat px-3" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger btn-flat px-3">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

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

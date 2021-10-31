@extends('layouts.app')

@section('head')

    <title>Crear Pedido - {{ config('app.name', 'Sistema') }}</title>

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
                            Crear Pedido
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <form action="{{ route('admin.pedidos.store') }}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-12">
                            <div class="card shadow-none">
                                <div class="card-body">

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
                                                            value="{{ $cliente->id }}">
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
                                                    value="{{ date('Y-m-d') }}"
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
                            </div>
                        </div>

                        <div class="col-12 col-md-4 offset-md-8">
                            <div class="row">
                                <div class="col-6 pl-md-0">
                                    <a  href="{{ route('admin.pedidos.index') }}"
                                        class="btn btn-secondary btn-sm btn-flat btn-block">
                                        Cancelar
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

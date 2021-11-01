@extends('layouts.app')

@section('head')

    <title>Crear Nuevo Empleado - {{ config('app.name', 'Sistema') }}</title>

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
                            Crear Nuevo Empleado
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <form action="{{ route('admin.empleados.store') }}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-12">
                            <div class="card shadow-none">
                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 mb-3">
                                            <h4 class="font-weight-bold">Información del Empleado</h4>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="nombre"
                                                    name="nombre"
                                                    placeholder="Nombre del empleado"
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
                                                    placeholder="Apellido del empleado"
                                                    autocomplete="off"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fecha_nac">Fecha de Nacmiento</label>
                                                <input
                                                    type="date"
                                                    class="form-control"
                                                    id="fecha_nac"
                                                    name="fecha_nac"
                                                    autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="dpi">Dpi</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="dpi"
                                                    name="dpi"
                                                    placeholder="Dpi del empleado"
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
                                                    placeholder="Número de teléfono del empleado"
                                                    autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="direccion">Dirección</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="direccion"
                                                    name="direccion"
                                                    placeholder="Dirección del empleado"
                                                    autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-12 my-3">
                                            <h4 class="font-weight-bold">Información de Acceso al Sistema</h4>
                                            <p>Si desea que el empleado tenga acceso al sistema, ingrese una contraseña para el usuario</p>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Correo Electrónico</label>
                                                <input
                                                    type="email"
                                                    class="form-control"
                                                    id="email"
                                                    name="email"
                                                    placeholder="Correo electrónico del empleado"
                                                    autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password">Contraseña de Acceso</label>
                                                <input
                                                    type="password"
                                                    class="form-control"
                                                    id="password"
                                                    name="password"
                                                    placeholder="Contraseña de acceso del empleado"
                                                    autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="role">Rol del Usuario</label>
                                                <select
                                                    class="form-control select2bs4"
                                                    name="role"
                                                    id="role">
                                                    <option value="0">Seleccione un rol para el usuario</option>
                                                    @foreach ($roles as $role)
                                                        <option
                                                            value="{{ $role->id }}">
                                                            {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 my-3">
                                            <h4 class="font-weight-bold">Información Empresarial</h4>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cargo">Cargo</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="cargo"
                                                    name="cargo"
                                                    placeholder="Cargo del empleado"
                                                    autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="depto">Departamento</label>
                                                <select
                                                    class="form-control select2bs4"
                                                    name="depto"
                                                    id="depto"
                                                    required>
                                                    <option value="">Seleccione un departamento</option>
                                                    @foreach ($departamentos as $depto)
                                                        <option
                                                            value="{{ $depto->id }}">
                                                            {{ $depto->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fecha_alta">Fecha Alta</label>
                                                <input
                                                    type="date"
                                                    class="form-control"
                                                    id="fecha_alta"
                                                    name="fecha_alta"
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
                                    <a  href="{{ route('admin.empleados.index') }}"
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

@extends('layouts.app')

@section('head')

    <title>{{ $curso->nombre }} - {{ config('app.name', 'Sistema') }}</title>

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
                            <i class="fas fa-book mr-1"></i>
                            {{ $curso->nombre }}
                        </h1>
                    </div>
                    <div class="col-12">
                        <h2 class="text-dark m-0">
                            <a  href="{{ route('admin.grado.show', [$grado->id]) }}"
                                class="text-dark">
                                {{ $grado->nombre }} {{ $grado->seccion }}
                            </a>
                        </h2>
                    </div>
                    <div class="col-12">
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.grado.index') }}">
                                    {{ __('Grade')}}
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.grado.show', [$grado->id]) }}">
                                    {{ $grado->nombre }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ $curso->nombre }}
                            </li>
                        </ol>
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
                            <div class="card-body px-3">

                                <form action="{{ route('admin.curso.curso_docente.store', [$grado->id, $curso->id]) }}" method="POST">
                                    @csrf

                                    <div class="row py-4">

                                        <div class="col-md-10 mx-auto">
                                            <p class="h4 mb-5">
                                                Para modificar el docente de este curso, seleccione al colaborador en el cuadro de opciones.
                                                No se perderá ninguna información relacionada con el cursos como anuncios o actividades.
                                            </p>
                                        </div>

                                        <div class="col-md-10 mx-auto mb-4">
                                            <div class="form-group">
                                                <label>Docente Asignado al Curso</label>
                                                <select
                                                    class="form-control select2"
                                                    name="id_docente"
                                                    id="id_docente"
                                                    required>
                                                    @foreach ($docentes as $docente)
                                                        <option
                                                            value="{{ $docente->id_docente }}">
                                                            {{ $docente->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-10 mx-auto">
                                            <button
                                                type="submit"
                                                class="btn btn-success btn-block btn-flat btn-sm">
                                                <i class="fas fa-save mr-2"></i>
                                                {{ __('Save Changes') }}
                                            </button>
                                        </div>

                                    </div>
                                </form>
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

    @include('extensions.toast-process-result')

@endsection

@extends('layouts.app')

@section('head')

    <title>{{ $grado->nombre }} - {{ config('app.name', 'Sistema') }}</title>

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
                            <i class="fas fa-th-list mr-1"></i>
                            {{ $grado->nombre }}
                        </h1>
                    </div>
                    <div class="col-12">
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.grado.index') }}">
                                    {{ __('Grade')}}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ $grado->nombre }}
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
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                      <span class="info-box-text text-center text-muted">
                                          {{ __('Section') }}
                                      </span>
                                      <span class="h4 info-box-number text-center text-dark mb-0">
                                          {{ $grado->seccion == null ? "-" : $grado->seccion }}
                                      </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                      <span class="info-box-text text-center text-muted">
                                          {{ __('Section') }}
                                      </span>
                                      <span class="h4 info-box-number text-center text-dark mb-0">
                                          {{ $grado->nivel }}
                                      </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card shadow-none">
                            <div class="card-body px-3">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="col-12">
                                            <span class="font-weight-bold">
                                                {{ __('Modify') }}
                                            </span>
                                        </div>

                                        @can('admin.grado.edit')
                                            <div class="col-12">
                                                <a  href="{{ route('admin.grado.edit', [$grado->id]) }}"
                                                    class="text-dark">
                                                    {{ __('Edit Grade') }}
                                                </a>
                                            </div>
                                        @endcan

                                        @can('admin.grado.delete')
                                            <div class="col-12">
                                                <a  href="{{ route('admin.grado.delete', [$grado->id]) }}"
                                                    class="text-dark">
                                                    {{ __('Delete Grade') }}
                                                </a>
                                            </div>
                                        @endcan
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card shadow-none">
                            <div class="card-header pb-0">
                                <h2 class="card-title">
                                    {{ __('Students') }}
                                </h2>
                            </div>

                            <div class="card-body px-3">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card shadow-none border-0">
                                            <table id="principal" class="table hover-table display nowrap" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 30%">
                                                            {{ __('Name Student') }}
                                                        </th>
                                                        <th style="width: 20%">
                                                            {{ __('Gender') }}
                                                        </th>
                                                        <th style="width: 20%">
                                                            {{ __('Code') }}
                                                        </th>
                                                        <th style="width: 20%">
                                                            {{ __('Mineduc Code') }}
                                                        </th>
                                                        <th style="width: 10%">
                                                            {{ __('Actions') }}
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($estudiantes_del_grado as $estudiante)
                                                        <tr class="item">
                                                            <td class="bg-light">
                                                                <a  href="{{ route('admin.estudiante.show', [$estudiante->estudiante_id]) }}"
                                                                    class="text-dark text-wrap">
                                                                    <span class="font-weight-bold">{{ $estudiante->estudiante->apellido }},</span>
                                                                    {{ $estudiante->estudiante->nombre }}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                {{$estudiante->estudiante->genero}}
                                                            </td>
                                                            <td>
                                                                {{ $estudiante->estudiante_id }}
                                                            </td>
                                                            <td>
                                                                {{ $estudiante->estudiante->codigo_mineduc }}
                                                            </td>
                                                            <td class="text-right">
                                                                <a  href="{{ route('admin.estudiante.show', [$estudiante->estudiante_id]) }}"
                                                                    class="btn btn-success btn-sm btn-flat px-3"
                                                                    data-toggle="tooltip" data-placement="top" title="Ver Informacion Estudiante"
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



                    <div class="col-md-6">
                        <div class="card shadow-none">
                            <div class="card-header pb-0">
                                <h2 class="card-title">
                                    {{ __('Courses') }}
                                </h2>
                            </div>

                            <div class="card-body px-3">

                                <div class="row">

                                    @can('admin.curso.create')
                                        <div class="col-12">
                                            <a href="{{ route('admin.curso.create', [$grado->id]) }}" class="btn btn-success btn-flat btn-sm px-3 mb-4 mb-md-0">
                                                {{ __('Create Course') }}
                                            </a>
                                        </div>
                                    @endcan

                                    <div class="col-md-12">
                                        <div class="card shadow-none border-0">
                                            <table id="secondary" class="table hover-table display nowrap" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 55%">
                                                            {{ __('Name of Course') }}
                                                        </th>
                                                        <th style="width: 20%">
                                                            {{ __('Periods') }}
                                                        </th>
                                                        <th style="width: 25%">
                                                            {{ __('Actions') }}
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($cursos_del_grado as $asignacio_curso)
                                                        <tr class="item">
                                                            <td>
                                                                @can('admin.curso.show')
                                                                    <a  href="{{ route('admin.curso.show', [$grado->id, $asignacio_curso->id]) }}"
                                                                        class="text-dark text-wrap font-weight-bold">
                                                                        {{ $asignacio_curso->nombre }}
                                                                    </a>
                                                                @endcan
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $asignacio_curso->periodos }}
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="row p-0">
                                                                    @can('admin.curso.edit')
                                                                        <div class="col-8 p-1">
                                                                            <a  href="{{ route('admin.curso.show', [$grado->id, $asignacio_curso->id]) }}"
                                                                                class="btn btn-success btn-sm btn-flat btn-block"
                                                                                data-toggle="tooltip" data-placement="top" title="Ver Informacion Grado"
                                                                            >
                                                                                <i class="fas fa-id-card d-xl-none"></i>
                                                                                <span class="d-none d-xl-block">
                                                                                    <i class="fas fa-file-alt mr-2"></i>
                                                                                    {{ __('Card') }}
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                    @endcan

                                                                    @can('admin.curso.delete')
                                                                        <div class="col-4 p-1">
                                                                            <a  href="{{ route('admin.curso.delete', [$grado->id, $asignacio_curso->id]) }}"
                                                                                class="btn btn-danger btn-sm btn-flat btn-block"
                                                                                data-toggle="tooltip" data-placement="top" title="Ver Informacion Grado"
                                                                            >
                                                                                <i class="fas fa-trash"></i>
                                                                            </a>
                                                                        </div>
                                                                    @endcan
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
    <script src="{{ asset('scripts/secondary-datatable.js') }}"></script>

    @include('extensions.toast-process-result')

@endsection

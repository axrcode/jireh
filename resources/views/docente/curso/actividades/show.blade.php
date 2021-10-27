@extends('layouts.app')

@section('head')

    <title>Ver Actividad - {{ $curso->nombre }} - {{ $curso->grado->nombre }} - {{ config('app.name', 'Sistema') }}</title>

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
                    <div class="col-12 mb-2">
                        <h1 class="font-weight-bold m-0">
                            <i class="fas fa-book mr-1"></i>
                            {{ $curso->nombre }}
                        </h1>
                    </div>
                    <div class="col-12 mb-2">
                        <h4 class="text-dark m-0">
                            <a  href=""
                                class="text-dark">
                                {{ $curso->grado->nombre }} {{ $curso->grado->seccion }}
                            </a>
                        </h4>
                    </div>
                    <div class="col-12">
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item">
                                <a href="{{ route('docente.curso.index') }}">
                                    {{ __('Courses')}}
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="">
                                    {{ $curso->grado->nombre }}
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
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <div class="card shadow-none">
                                    <div class="card-body">
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <a  href="{{ route('docente.curso.anuncios.index', [$curso->id]) }}"
                                                class="nav-link">
                                                Anuncios
                                            </a>
                                            <a  href="{{ route('docente.curso.actividades.index', [$curso->id]) }}"
                                                class="nav-link active">
                                                Actividades
                                            </a>
                                            <a  href=""
                                                class="nav-link">
                                                Material de Aprendizaje
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-9">

                                <div class="card shadow-none">
                                    <div class="card-header pb-0 bg-white border-0">

                                        <div class="card-tools">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" role="menu">

                                                    <a  href="{{ route('docente.curso.actividades.edit', [$curso->id, $actividad->id]) }}"
                                                        class="dropdown-item">
                                                        Editar
                                                    </a>

                                                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete_actividad_{{ $actividad->id }}">
                                                        Eliminar
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body pt-0">

                                        <div class="row">
                                            <div class="col-12">
                                                <h3 class="font-weight-bold mb-4">
                                                    <i class="fas fa-tasks mr-2"></i>
                                                    Actividad
                                                </h3>
                                            </div>

                                            <div class="col-12">
                                                <h2>{{ $actividad->titulo }}</h2>
                                                <p class="text-muted h5">
                                                    {{ $actividad->descripcion }}
                                                </p>

                                                @if ( ! $actividad->fecha_apertura == null )
                                                    <div class="text-muted mt-4">
                                                        <p class="text-sm font-weight-bold">
                                                            Fecha Apertura:
                                                            <span class="d-block font-weight-normal">
                                                                {{ date('d/m/Y, g:i a', strtotime($actividad->fecha_apertura)) }}</span>
                                                            </span>
                                                        </p>
                                                    </div>
                                                @endif

                                                @if ( ! $actividad->fecha_vencimiento == null )
                                                    <div class="text-muted mt-4">
                                                        <p class="text-sm font-weight-bold">
                                                            Fecha Vencimiento:
                                                            <span class="d-block font-weight-normal">
                                                                {{ date('d/m/Y, g:i a', strtotime($actividad->fecha_vencimiento)) }}</span>
                                                            </span>
                                                        </p>
                                                    </div>
                                                @endif

                                                @if ( ! $actividad->fecha_cierre == null )
                                                    <div class="text-muted mt-4">
                                                        <p class="text-sm font-weight-bold">
                                                            Fecha Cierre:
                                                            <span class="d-block font-weight-normal">
                                                                {{ date('d/m/Y, g:i a', strtotime($actividad->fecha_cierre)) }}</span>
                                                            </span>
                                                        </p>
                                                    </div>
                                                @endif

                                                <h5 class="mt-4 text-muted font-weight-bold">
                                                    Archivos Adjuntos
                                                </h5>

                                                <ul class="list-unstyled">
                                                    <li>
                                                        <a href="" class="btn-link text-secondary">
                                                            <i class="fas fa-file-word mr-1"></i>
                                                            Functional-requirements.docx
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="" class="btn-link text-secondary">
                                                            <i class="fas fa-file-pdf mr-1"></i>
                                                            Tarea-yuli.pdf
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="" class="btn-link text-secondary">
                                                            <i class="fas fa-image mr-1"></i>
                                                            Logo.png
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- Modal para eliminar anuncio -->
                                <div class="modal fade" id="delete_actividad_{{ $actividad->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    <i class="fas fa-trash mr-2"></i>
                                                    Eliminar Anuncio
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Desea eliminar el anuncio
                                                <b>{{ $actividad->titulo }}</b>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light btn-flat" data-dismiss="modal">Cancelar</button>
                                                <form action="{{ route('docente.curso.anuncios.destroy', [$curso, $actividad->id]) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-flat">Confirmar</button>
                                                </form>
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
    </div>

    <!-- Control Sidebar -->
    @include('layouts.aside')

    <!-- Main Footer -->
    @include('layouts.footer')

</div>

@endsection

@section('scripts')

    <script src="{{ secure_asset('scripts/tertiary-datatable.js') }}"></script>

    @include('extensions.toast-process-result')

@endsection

@extends('layouts.app')

@section('head')

    <title>Actividades - {{ $curso->nombre }} - {{ $curso->grado->nombre }} - {{ config('app.name', 'Sistema') }}</title>

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

                                <div class="col-12 col-md-3 offset-md-9 mb-3 p-0">
                                    <a  href="{{ route('docente.curso.actividades.create', [$curso]) }}"
                                        class="btn btn-success btn-block btn-flat btn-sm">
                                        <i class="fas fa-plus-square mr-1"></i>
                                        Crear nueva actividad
                                    </a>
                                </div>

                                @livewire('docente.cursos.actividades', [$curso->id])

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

    <script src="{{ asset('scripts/tertiary-datatable.js') }}"></script>

    @include('extensions.toast-process-result')

@endsection

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
                        <h4 class="text-muted m-0">
                            <span class="font-weight-bold">{{ __('Teacher') }}:</span>
                            @if ( !$curso->curso_docente )
                                <span class="text-danger font-weight-bold">
                                    No asignado
                                </span>
                            @else
                                <a  href="{{ route('admin.colaborador.show', [$curso->curso_docente->docente->id]) }}"
                                    class="text-muted">
                                    {{ $curso->curso_docente->docente->user->name }}
                                </a>
                            @endif
                        </h4>
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
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="col-12">
                                            <span class="font-weight-bold">
                                                {{ __('Modify') }}
                                            </span>
                                        </div>

                                        @can('admin.curso.edit')
                                            <div class="col-12">
                                                <a  href="{{ route('admin.curso.edit', [$grado->id, $curso->id]) }}"
                                                    class="text-dark">
                                                    {{ __('Edit Course') }}
                                                </a>
                                            </div>
                                        @endcan

                                        @can('admin.curso.delete')
                                            <div class="col-12">
                                                <a  href="{{ route('admin.curso.delete', [$grado->id, $curso->id]) }}"
                                                    class="text-dark">
                                                    {{ __('Delete Course') }}
                                                </a>
                                            </div>
                                        @endcan

                                        <div class="col-12">
                                            <a  href="{{ route('admin.curso.curso_docente.create', [$grado->id, $curso->id]) }}"
                                                class="text-dark">
                                                Cambiar Docente
                                            </a>
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

    <script src="{{ asset('scripts/cursos_grado-datatable.js') }}"></script>

    @include('extensions.toast-process-result')

@endsection

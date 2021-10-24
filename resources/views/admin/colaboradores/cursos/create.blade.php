@extends('layouts.app')

@section('head')

    <title>{{ $colaborador->user->name }} - {{ config('app.name', 'Sistema') }}</title>

    <!-- Livewire Style -->
    @livewireStyles()

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
                    <div class="col-sm-6">
                        <h1 class="font-weight-bold m-0">
                            <i class="fas fa-users mr-1"></i>
                            {{ __('Collaborator File') }}
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.colaborador.index') }}">
                                    {{ __('Collaborators')}}
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.colaborador.show', [$colaborador->id]) }}">
                                    {{ $colaborador->user->name }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ __('Courses') }}
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
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-12 col-md-11 px-4">
                                        <h2 class="font-weight-bold mt-4 mt-md-2">
                                            {{ $colaborador->nombre }} {{ $colaborador->apellido }}
                                        </h2>

                                        <dl class="row mb-2">
                                            <dt class="col-sm-6">
                                                {{ __('System Code') }}:
                                                <span class="font-weight-normal mr-5">{{ $colaborador->id }}</span>

                                                {{ __('Employee Code') }}:
                                                <span class="font-weight-normal">{{ $colaborador->codigo_empleado }}</span>
                                            </dt>
                                        </dl>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card shadow-none">
                            <div class="card-body px-3">
                                <div class="row">

                                    @livewire('empleados.cursos.obtener-cursos-grados')

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card shadow-none">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-12">

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

    <!-- Livewire Scripts -->
    @livewireScripts

@endsection

@extends('layouts.app')

@section('head')

    <title>{{ __('Dashboard') }} - {{ config('app.name', 'Sistema') }}</title>

@endsection

@section('content')

<div class="wrapper">

    <!--    Navbar    -->
    @include('layouts.navbar')

    <!--    Main Sidebar Container    -->
    @include('layouts.drawer')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper text-sm">

        <!-- Preloader -->
        {{-- <div class="dark-mode">
            <div class="preloader flex-column justify-content-center align-items-center">
                <img
                    class="animation__wobble"
                    src="{{ $empresa->logo }}"
                    alt="AdminLTELogo"
                    height="150" width="200"
                >
            </div>
        </div> --}}

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="font-weight-bold m-0">
                            <i class="fas fa-tachometer-alt mr-1"></i>
                            {{ __('Dashboard') }}
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Starter Page</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">

                    <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                        <a href="{{ route('admin.colaborador.index') }}" class="text-decoration-none">
                            <div class="small-box bg-gradient-lightblue">
                                <div class="inner">
                                    <h3>{{ $total_colaboradores }}</h3>
                                    <p>{{ __('Collaborators') }}</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                        <a href="{{ route('admin.estudiante.index') }}" class="text-decoration-none">
                            <div class="small-box bg-gradient-teal">
                                <div class="inner">
                                    <h3>{{ $total_estudiantes }}</h3>
                                    <p>{{ __('Students') }}</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                        <a href="{{ route('admin.estudiante.index') }}" class="text-decoration-none">
                            <div class="small-box bg-gradient-indigo">
                                <div class="inner">
                                    <h3>{{ $total_inscripciones }}</h3>
                                    <p>Inscripciones</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-file-signature"></i>
                                </div>
                            </div>
                        </a>
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

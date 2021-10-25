@extends('layouts.app')

@section('head')

    <title>{{ __('Enroll Student') }} - {{ $estudiante->user->name }} - {{ config('app.name', 'Sistema') }}</title>

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
                            <i class="fas fa-user-graduate mr-1"></i>
                            {{ __('Enroll Student') }} - {{ $estudiante->user->name }}
                        </h1>
                    </div>
                    <div class="col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.estudiante.index') }}">
                                    {{ __('Students')}}
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.estudiante.show', [$estudiante->id]) }}">
                                    {{ $estudiante->user->name }}
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.estudiante.inscripcion', [$estudiante->id]) }}">
                                    {{ __('Enroll Student') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ __('Confirm Enrollment') }}
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

                                    <div class="col-12">
                                        <p class="h3">
                                            {{ __('Enroll') }} a <b>{{ $estudiante->user->name }}</b>
                                        </p>

                                        <p class="h3">
                                            en: <b>{{ $grado->nombre }}</b>
                                        </p>
                                    </div>

                                    <div class="col-12">
                                        <div class="alert alert-info mt-3" role="alert">
                                            {{ __("To confirm the change, press the 'Confirm' button.") }}
                                        </div>
                                    </div>

                                    <div class="col-2 mx-auto">
                                        <form action="{{ route('admin.estudiante.inscribir', [$estudiante->id, $grado->id]) }}" method="POST">
                                            @csrf

                                            <button class="btn btn-success btn-flat btn-block">
                                                {{ __('Confirm') }}
                                            </button>
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

    <!-- Control Sidebar -->
    @include('layouts.aside')

    <!-- Main Footer -->
    @include('layouts.footer')

</div>

@endsection

@section('scripts')

    <script src="{{ secure_asset('scripts/cambiar_grado_estudiante-datatable.js') }}"></script>

    @include('extensions.toast-process-result')

@endsection

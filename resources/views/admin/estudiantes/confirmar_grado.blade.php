@extends('layouts.app')

@section('head')

    <title>{{ __('Confirm Grade') }} - {{ $estudiante->user->name }} - {{ config('app.name', 'Sistema') }}</title>

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
                            {{ __('Change Grade') }} - {{ $estudiante->user->name }}
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
                                <a href="{{ route('admin.estudiante.cambiargrado', [$estudiante->id]) }}">
                                    {{ __('Change Grade') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ __('Confirm Grade') }}
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
                                            Moviendo a <b>{{ $estudiante->user->name }}</b>
                                        </p>

                                        @php $asignacion_grado = $estudiante->asignacion_grado->where('cicloescolar_id', $academico_actual->cicloescolar_id)->first() @endphp

                                        <p class="h3">
                                            De: <b>{{ empty($asignacion_grado) ? '-' : $asignacion_grado->grado->nombre }}</b>
                                        </p>

                                        <p class="h3">
                                            a: <b>{{ $grado->nombre }}</b>
                                        </p>
                                    </div>

                                    <div class="col-12">
                                        <div class="alert alert-info mt-3" role="alert">
                                            {{ __("To confirm the change, press the 'Confirm' button.") }}
                                        </div>
                                    </div>

                                    <div class="col-2 mx-auto">
                                        <form action="{{ route('admin.estudiante.nuevogrado', [$estudiante->id, $grado->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')

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

    <script src="scripts/cambiar_grado_estudiante-datatable.js"></script>

    @include('extensions.toast-process-result')

@endsection

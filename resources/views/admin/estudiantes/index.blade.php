@extends('layouts.app')

@section('head')

    <title>{{ __('Students') }} - {{ config('app.name', 'Sistema') }}</title>

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
                            {{ __('Students') }}
                        </h1>
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
                                    @can('admin.estudiante.index')
                                        <div class="col-md-4">
                                            <a  href="{{ route('admin.estudiante.create') }}"
                                                class="btn btn-success btn-sm btn-flat px-3">
                                                <i class="fas fa-plus-square mr-2"></i>
                                                {{ __('Create Student') }}
                                            </a>
                                        </div>
                                    @endcan
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card shadow-none">

                            <div class="card-body px-3">
                                <table id="principal" class="table hover-table display nowrap" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width: 30%">
                                                {{ __('Name Student') }}
                                            </th>
                                            <th style="width: 20%">
                                                {{ __('Code') }}
                                            </th>
                                            <th style="width: 40%">
                                                {{ __('Degre') }}
                                            </th>
                                            <th style="width: 10%">
                                                {{ __('Actions') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($estudiantes as $estudiante)
                                            <tr class="item">
                                                <td class="bg-light">
                                                    <a  href="{{ route('admin.estudiante.show', [$estudiante->id]) }}"
                                                        class="text-dark text-wrap">
                                                        <span class="font-weight-bold">{{ $estudiante->apellido }},</span>
                                                        {{ $estudiante->nombre }}
                                                    </a>
                                                </td>
                                                <td>
                                                    {{ $estudiante->id }}
                                                </td>
                                                <td>
                                                    <span class="text-dark text-wrap">
                                                        @php $asignacion_grado = $estudiante->asignacion_grado->where('cicloescolar_id', $academico_actual->cicloescolar_id)->first() @endphp

                                                        {{ empty($asignacion_grado) ? '-' : $asignacion_grado->grado->nombre }}
                                                    </span>
                                                </td>
                                                <td class="text-right">
                                                    <a  href="{{ route('admin.estudiante.show', [$estudiante->id]) }}"
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
    </div>

    <!-- Control Sidebar -->
    @include('layouts.aside')

    <!-- Main Footer -->
    @include('layouts.footer')

</div>

@endsection

@section('scripts')

    <script src="{{ asset('scripts/principal-datatable.js') }}"></script>

    @include('extensions.toast-process-result')

@endsection

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
                            <li class="breadcrumb-item active">
                                {{ __('Enroll Student') }}
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

                                <table id="principal" class="table hover-table display nowrap" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width: 60%">
                                                {{ __('Name Grade or Career') }}
                                            </th>
                                            <th style="width: 15%">
                                                {{ __('Section') }}
                                            </th>
                                            <th style="width: 15%">
                                                {{ __('Level')  }}
                                            </th>
                                            <th style="width: 10%">
                                                {{ __('Actions') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($grados as $grado)
                                            <tr class="item">
                                                <td class="bg-light">
                                                    <a  href="{{ route('admin.grado.show', [$grado->id]) }}"
                                                        class="text-dark text-wrap">
                                                        {{ $grado->nombre }}
                                                    </a>
                                                </td>
                                                <td class="text-center text-md-left">
                                                    {{ $grado->seccion }}
                                                </td>
                                                <td>
                                                    {{ $grado->nivel }}
                                                </td>
                                                <td class="text-right">
                                                    @can('admin.estudiante.confirmarinscripcion')
                                                        <a  href="{{ route('admin.estudiante.confirmarinscripcion', [$estudiante->id, $grado->id]) }}"
                                                            class="btn btn-success btn-sm btn-flat px-3"
                                                            data-toggle="tooltip" data-placement="top" title="Ver Informacion Grado"
                                                        >
                                                            <i class="fas fa-plus-square mr-2"></i>
                                                            {{ __('Assign Grade') }}
                                                        </a>
                                                    @endcan
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

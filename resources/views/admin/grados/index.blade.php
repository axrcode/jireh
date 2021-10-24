@extends('layouts.app')

@section('head')

    <title>{{ __('Grade') }} - {{ config('app.name', 'Sistema') }}</title>

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
                            {{ __('Grade') }}
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
                                    @can('admin.grado.create')
                                        <div class="col-md-4">
                                            <a  href="{{ route('admin.grado.create') }}"
                                                class="btn btn-success btn-sm btn-flat px-3">
                                                <i class="fas fa-plus-square mr-2"></i>
                                                {{ __('Create Grade') }}
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
                                            <th style="width: 40%">
                                                {{ __('Name Grade or Career') }}
                                            </th>
                                            <th style="width: 10%">
                                                {{ __('Section') }}
                                            </th>
                                            <th style="width: 20%">
                                                {{ __('Level')  }}
                                            </th>
                                            <th style="width: 10%">
                                                {{ __('Students') }}
                                            </th>
                                            <th style="width: 10%">
                                                {{ __('Courses') }}
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
                                                    @can('admin.grado.show')
                                                        <a  href="{{ route('admin.grado.show', [$grado->id]) }}"
                                                            class="text-dark font-weight-bold text-wrap">
                                                            {{ $grado->nombre }}
                                                        </a>
                                                    @endcan
                                                </td>
                                                <td class="text-center text-md-left">
                                                    {{ $grado->seccion }}
                                                </td>
                                                <td>
                                                    {{ $grado->nivel }}
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-right">
                                                    @can('admin.grado.show')
                                                        <a  href="{{ route('admin.grado.show', [$grado->id]) }}"
                                                            class="btn btn-success btn-sm btn-flat px-3"
                                                            data-toggle="tooltip" data-placement="top" title="Ver Informacion Grado"
                                                        >
                                                            <i class="fas fa-id-card mr-2"></i>
                                                            {{ __('Card') }}
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

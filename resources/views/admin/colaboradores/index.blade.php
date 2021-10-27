@extends('layouts.app')

@section('head')

    <title>{{ __('Collaborators') }} - {{ config('app.name', 'Sistema') }}</title>

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
                            <i class="fas fa-users mr-1"></i>
                            {{ __('Collaborators') }}
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
                                    <div class="col-md-4">
                                        @can('admin.colaborador.create')
                                            <a  href="{{ route('admin.colaborador.create') }}"
                                                class="btn btn-success btn-sm btn-flat px-3">
                                                <i class="fas fa-plus-square mr-2"></i>
                                                {{ __('Create Collaborator') }}
                                            </a>
                                        @endcan
                                    </div>
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
                                            <th style="width: 35%">
                                                {{ __('Name Collaborator') }}
                                            </th>
                                            <th style="width: 15%">
                                                {{ __('Code') }}
                                            </th>
                                            <th style="width: 20%">
                                                {{ __('Workstation') }}
                                            </th>
                                            <th style="width: 20%">
                                                {{ __('Users Type') }}
                                            </th>
                                            <th style="width: 10%">
                                                {{ __('Actions') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($colaboradores as $colaborador)
                                            <tr class="item">
                                                <td class="bg-light">
                                                    <a  href="{{ route('admin.colaborador.show', [$colaborador->id]) }}"
                                                        class="text-dark text-wrap">
                                                        <span class="font-weight-bold">{{ $colaborador->apellido }},</span>
                                                        {{ $colaborador->nombre }}
                                                    </a>
                                                </td>
                                                <td>
                                                    {{ $colaborador->id }}
                                                </td>
                                                <td>
                                                    {{ $colaborador->cargo }}
                                                </td>
                                                <td>
                                                    {{ $colaborador->user->roles()->first()->name }}
                                                </td>
                                                <td class="text-right">
                                                    <a  href="{{ route('admin.colaborador.show', [$colaborador->id]) }}"
                                                        class="btn btn-success btn-sm btn-flat px-3"
                                                        data-toggle="tooltip" data-placement="top" title="Ver Informacion Colaborador"
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

    <script src="/scripts/principal-datatable.js"></script>

    @include('extensions.toast-process-result')

@endsection

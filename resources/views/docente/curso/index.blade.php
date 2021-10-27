@extends('layouts.app')

@section('head')

    <title>{{ __('Courses') }} - {{ config('app.name', 'Sistema') }}</title>

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
                            <i class="fas fa-book-open mr-1"></i>
                            {{ __('My Courses') }}
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
                                @if ($cursos != __('The profesor has no assigned courses'))
                                    <table id="tertiary" class="table hover-table display nowrap" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 40%">
                                                    {{ __('Courses') }}
                                                </th>
                                                <th style="width: 50%">
                                                    {{ __('Degre') }}
                                                </th>
                                                <th style="width: 10%">
                                                    {{ __('Actions') }}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cursos as $curso)
                                                <tr class="item">
                                                    <td>
                                                        <a  href="{{ route('docente.curso.anuncios.index', [$curso->id_curso]) }}"
                                                            class="text-wrap font-weight-bold text-dark">
                                                            {{ $curso->name_curso }}
                                                        </a>
                                                    </td>
                                                    <td class="text-wrap">
                                                        {{ $curso->name_grado }}
                                                    </td>
                                                    <td>
                                                        <a  href="{{ route('docente.curso.anuncios.index', [$curso->id_curso]) }}"
                                                            class="btn btn-success btn-flat btn-sm">
                                                            <i class="fas fa-id-card mr-2"></i>
                                                            {{ __('Card') }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="p-3">
                                        <div class="alert alert-light shadow-sm border text-center m-0" role="alert">
                                            {{ $cursos }}
                                        </div>
                                    </div>
                                @endif
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

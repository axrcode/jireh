@extends('layouts.app')

@section('head')

    <title>{{ __('Create Code for Inscription') }} - {{ config('app.name', 'Sistema') }}</title>

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
                            <i class="fas fa-lock mr-1"></i>
                            {{ __('Codes for Inscriptions') }}
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
                        <div class="callout callout-info">
                            <h5><i class="fas fa-info-circle"></i> {{ __('Note') }}:</h5>
                            Los códigos que se generan son válidos únicamente para una inscripción.
                            Una vez realizada la inscripción no se podrá hacer uso del mismo código por lo que deberá generar uno nuevo.
                        </div>
                    </div>

                    {{-- <a href="{{ route('admin.pdf.codigo_inscripcion') }}" class="btn btn-success">
                        Ver pdf
                    </a>

                    <a class="btn btn-outline-info" onclick='window.open("{{ route("admin.pdf.codigo_inscripcion.show", [$codigo_inscripcion->id]) }}", "_blank", "width=400, height=475")'>
                        Ver 222
                    </a> --}}

                    <div class="col-md-4">
                        <div class="callout callout-info py-4">

                            <form action="{{ route('admin.inscripcion.codigo.store') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="font-weight-bold text-center">
                                            {{ $codigo_sugerido }}
                                        </h1>
                                    </div>

                                    <input type="hidden" value="{{ $codigo_sugerido }}" name="new_codigo">

                                    <div class="col-8 mx-auto">
                                        <button type="submit" class="btn btn-success btn-flat btn-block"
                                            onclick="javascript=this.disabled = true; form.submit();"
                                        >
                                            <i class="fas fa-save mr-2"></i>
                                            Generar Código
                                        </button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card shadow-none">

                            <div class="card-body px-3">
                                <table id="principal" class="table hover-table display nowrap" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width: 35%">
                                                {{ __('Codes for Inscriptions') }}
                                            </th>
                                            <th style="width: 35%" class="text-center">
                                                {{ __('Status') }}
                                            </th>
                                            <th style="width: 30%" class="text-right">
                                                {{ __('Actions') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($codigos_inscripciones as $codigo_inscripcion)
                                            <tr class="item">
                                                <td class="bg-light font-weight-bold text-center text-md-left">
                                                    {{ $codigo_inscripcion->id }}
                                                </td>
                                                <td class="text-center">
                                                    @if ($codigo_inscripcion->estado == true)
                                                        <span class="badge badge-success px-2 py-1">Activo</span>
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    <form action="{{ route('admin.inscripcion.codigo.destroy', [$codigo_inscripcion->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <a  href="{{ route("admin.inscripcion.codigo.show", [$codigo_inscripcion->id]) }}"
                                                            class="btn btn-primary btn-sm btn-flat" target="__blank"
                                                            data-toggle="tooltip" data-placement="top" title="{{ __('View') }}"
                                                        >
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <a  href="{{ route("admin.pdf.codigo_inscripcion.show", [$codigo_inscripcion->id]) }}"
                                                            class="btn btn-secondary btn-sm btn-flat" target="__blank"
                                                            data-toggle="tooltip" data-placement="top" title="{{ __('Download') }}"
                                                        >
                                                            <i class="fas fa-download"></i>
                                                        </a>

                                                        <button type="submit" class="btn btn-danger btn-sm btn-flat"
                                                            data-toggle="tooltip" data-placement="top" title="{{ __('Delete') }}"
                                                            onclick="javascript=this.disabled = true; form.submit();"
                                                        >
                                                            <i class="fas fa-times-circle"></i>
                                                        </button>
                                                    </form>
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

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

@endsection

@extends('layouts.app')

@section('head')

    <title>{{ __('Grade or Career') }} - {{ config('app.name', 'Sistema') }}</title>

@endsection

@section('content')

<div class="px-4 encabezado-inscripciones">
    <div class="row text-center text-white vertical-center">

        <div class="col-6 col-md-2 mx-auto">
            <img src="{{ $empresa->logo }}" alt="Logo" class="w-100">
        </div>

        <div class="col-12 mb-5">
            <h1 class="font-weight-bold">
                Seleccionar Grado
            </h1>
        </div>

    </div>
</div>

<div class="bg-white">
    <div class="container">

        <div class="row py-5">

            <div class="col-md-12 mb-3">
                <div class="callout callout-info">
                    <h2>
                        <i class="fas fa-info-circle mr-1"></i>
                        {{ __('Note') }}
                    </h2>
                    <h5>
                        Seleccionar el grado en el que se desea inscribir al estudiante
                        <b class="text-primary">{{ $info_inscripcion->estudiante->user->name }}</b> para el
                        <b class="text-primary">Ciclo Escolar {{ $academico_actual->cicloinscripciones->ciclo }}</b>
                    </h5>
                </div>
            </div>

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
                                            <span class="text-dark text-wrap">
                                                {{ $grado->nombre }}
                                            </span>
                                        </td>
                                        <td class="text-center text-md-left">
                                            {{ $grado->seccion }}
                                        </td>
                                        <td>
                                            {{ $grado->nivel }}
                                        </td>
                                        <td class="text-right">

                                            <!-- Button trigger modal {{$grado->nombre}} {{ $grado->seccion }} -->
                                            <button type="button" class="btn btn-success btn-flat btn-sm px-3" data-toggle="modal" data-target="#grado-{{$grado->id}}">
                                                <i class="fas fa-plus-square mr-2"></i>
                                                {{ __('Assign Grade') }}
                                            </button>

                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>

        @foreach ($grados as $grado)

            <form action="{{ route('public.inscripcion.grado.save') }}" method="POST">
                @csrf
                <!-- Modal {{$grado->nombre}} {{ $grado->seccion }} -->
                <div class="modal fade" id="grado-{{$grado->id}}" tabindex="-1" aria-labelledby="gradoLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="gradoLabel{{ $grado->id }}">
                                    <i class="fas fa-check-double mr-1"></i>
                                    <b>Confirmar Inscripción</b>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <input type="hidden" value="{{$info_inscripcion->estudiante_id}}" name="estudiante_id">
                                <input type="hidden" value="{{$grado->id}}" name="grado_id">

                                <p class="text-left text-wrap">
                                    ¿Esta seguro que desea inscribir al estudiante en el grado de
                                    <b>{{ $grado->nombre }} - {{ $grado->seccion }}</b>
                                    ?
                                    <span class="text-danger">Este proceso es irreversible</span>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary btn-flat" data-dismiss="modal">
                                    Cancelar
                                </button>

                                <button type="submit" class="btn btn-success btn-flat" id="btnInscribir"
                                    onclick="javascript=this.disabled = true; form.submit();"
                                >
                                    Confirmar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

        @endforeach

    </div>
</div>


<!-- Inicio Footer -->
<footer class="text-muted text-sm">
    <div class="px-3 px-md-5 py-3">
        <div class="float-md-right">
            Desarrollado por
            <a href="https://axrcode.me" class="text-decoration-none font-weight-bold text-secondary" target="_blank">
                axrcode
            </a>
        </div>
        <strong>
            Theme by.
            <a href="https://adminlte.io" target="_blank">AdminLTE</a>
        </strong>
        &copy; {{ date('Y') }} {{ $empresa->nombre }}
    </div>
</footer>
<!-- Fin Footer -->

@endsection

@section('scripts')

    <script src="{{ asset('scripts/principal-datatable.js') }}"></script>

    @include('extensions.toast-process-result')

@endsection


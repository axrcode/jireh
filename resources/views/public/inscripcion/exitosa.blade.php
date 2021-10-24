@extends('layouts.app')

@section('head')

    <title>{{ __('Incription Successfully') }} - {{ config('app.name', 'Sistema') }}</title>

@endsection

@section('content')

<div class="px-4 encabezado-inscripciones">
    <div class="row text-center text-white vertical-center">

        <div class="col-6 col-md-2 mx-auto">
            <img src="{{ $empresa->logo }}" alt="Logo" class="w-100">
        </div>

        <div class="col-12 mb-5">
            <h1 class="font-weight-bold">
                <i class="fas fa-check-circle mr-1 text-success"></i>
                {{ __('Incription Successfully') }}
            </h1>
        </div>

    </div>
</div>

<div class="bg-white">
    <div class="container">

        <div class="row py-5">

            <div class="col-12 mb-3">

                @include('public.inscripcion.notificacion')

            </div>

        </div>

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


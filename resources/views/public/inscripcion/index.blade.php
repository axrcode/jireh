@extends('layouts.app')

@section('head')

    <title>{{ __('Inscripcion') }} - {{ config('app.name', 'Sistema') }}</title>

@endsection

@section('content')

<div class="px-2 px-md-0 pr-md-3">
    <div class="row">
        <div class="col-7 d-none d-lg-block bg-inscripciones">

        </div>
        <div class="col-12 col-lg-5 px-0 bg-pin-validation">
            <div class="login-page px-4 bg-transparent">

                <div class="login-logo d-lg-none mb-3">
                    <img src="{{ asset('icons/logo-inscripciones.png') }}" alt="CBP" class="img-login-2">
                </div>

                <div class="card px-md-5 mt-n5 bg-gris-login shadow-none border-0">
                    <div class="card-body p-md-5 bg-transparent">

                        <form action="{{ route('public.inscripcion.validacion') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-12">
                                    <h3 class="login-box-msg font-weight-bold">
                                        Registrar Datos
                                    </h3>

                                    <p class="h5 text-center pb-4">
                                        Ingrese el código de validación para inscribir al estudiante en el siguiente Ciclo Escolar.
                                    </p>
                                </div>

                                <div class="col-8 coo-md-6 mx-auto">
                                    <div class="input-group mb-3">
                                        <input
                                            type="text"
                                            class="form-control text-center @error('codigo') is-invalid @enderror"
                                            id="codigo"
                                            name="codigo"
                                            placeholder="{{ __('Your Code') }}"
                                            minlength="6"
                                            maxlength="6"
                                            autocomplete="off"
                                            required
                                            value="{{ old('codigo') }}"
                                        >

                                        <div class="input-group-append d-md-none">
                                            <button class="btn bg-gradient-primary text-white px-3" type="submit">
                                                <i class="fas fa-arrow-alt-circle-right"></i>
                                            </button>
                                        </div>

                                        @error('codigo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 mx-auto text-center">
                                    <p class="text-center pt-3">
                                        Si aún no posee un <b>código</b>, debe solicitarlo a secretaría.
                                    </p>
                                </div>

                                <div class="col-6 coo-md-4 mx-auto text-center">
                                    <a  href="{{ $empresa->whatsapp }}" target="_blank"
                                        class="btn bg-gradient-green text-white btn-sm btn-block">
                                        <i class="fab fa-whatsapp mr-2"></i>
                                        Whastapp
                                    </a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

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

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('[data-mask]').inputmask()
    })
</script>

@endsection

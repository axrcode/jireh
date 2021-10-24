@extends('layouts.app')

@section('head')

    <title>{{ __('Login') }} - {{ config('app.name', 'Sistema') }}</title>

@endsection

@section('content')

<div class="login-box">

    <div class="card border-0">

        <div class="card-header text-center bg-light p-0">
            <img
                src="{{ $empresa->logo }}"
                alt="Logo Empresa"
                class="w-50"
            >
        </div>

        <div class="card-body px-4 pt-5">

            <h4 class="login-box-msg text-secondary pb-3">
                Acceder al Sistema
            </h4>

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="input-group pb-3">
                    <input
                        name="user"
                        id="user"
                        type="text"
                        class="form-control form-control-border @error('user') is-invalid @enderror bg-transparent"
                        value="{{ old('user') }}"
                        autocomplete="off"
                        placeholder="Usuario"
                        required
                    >

                </div>
                <div class="input-group pb-3 mb-4">
                    <input
                        name="password"
                        id="password"
                        type="password"
                        class="form-control form-control-border @error('password') is-invalid @enderror bg-transparent"
                        placeholder="Contraseña"
                        autocomplete="off"
                        required
                    >
                    <span class="icon-password">
                        <i class="fas fa-eye" aria-hidden="true"
                            onclick="toggle()" id="eye-password">
                        </i>
                    </span>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="btn btn-primary btn-block btn-flat">
                    Iniciar Sesión
                </button>

            </form>

            <p class="mt-4 mb-3 text-center">
                <a href="">
                    ¿Olvidaste tu contraseña?
                </a>
            </p>

            @error('user')
                <div class="alert alert-danger text-center mt-3" role="alert">
                    <i class="fas fa-info-circle mr-2"></i>
                    Credenciales Inválidas
                </div>
            @enderror

            @if (session()->has('flash'))
                <div class="alert alert-danger text-center mt-3" role="alert">
                    <i class="fas fa-info-circle mr-2"></i>
                    {{ session('flash') }}
                </div>
            @endif

        </div>

        <div class="card-footer text-center">
            <small class="text-muted">
                &copy; <b>{{ date('Y') }}</b> {{ $empresa->nombre }}
            </small>
        </div>
    </div>

</div>

@endsection

@section('scripts')

    <script>
        var state = false;
        function toggle()
        {
            if (state)
            {
                document.getElementById("password").setAttribute("type", "password");
                document.getElementById("eye-password").setAttribute("class", "fas fa-eye");
                state = false;
            }
            else
            {
                document.getElementById("password").setAttribute("type", "text");
                document.getElementById("eye-password").setAttribute("class", "fas fa-eye-slash");
                state = true;
            }
        }
    </script>

@endsection

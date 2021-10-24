@extends('layouts.app')

@section('head')

    <title>{{ __('Login') }} - {{ config('app.name', 'Sistema') }}</title>

@endsection

@section('content')

    <div class="px-2 px-md-5 bg-gris-login">
        <div class="row">
            <div class="col-7 d-none d-lg-block">
                <div class="container mx-5 px-5">
                    <div class="hold-transition login-page bg-transparent px-5 mx-5 mt-n3">

                        <div class="login-logo m-0 mt-n5">
                            <img src="{{ $empresa->logo }}" alt="Logo" class="img-login w-100">
                        </div>

                        <div class="text-muted text-center mt-n5">

                            <div class="text-amber mb-3">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>

                            <div class="container px-3 text-center d-none d-xl-block">
                                <span class="h5">
                                    {{ $empresa->slogan }}
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="hold-transition login-page">
                    <div class="login-box">

                        <div class="login-logo d-lg-none mt-n5">
                            <img src="{{ $empresa->logo }}" alt="CBP" class="img-login-2">
                        </div>

                        <div class="card p-3 p-md-3 shadow mt-n5 bg-transparent">
                            <div class="card-body login-card-body bg-transparent">

                                <h3 class="login-box-msg">Acceder al Sistema</h3>

                                <form action="{{ route('login') }}" method="POST">
                                    @csrf

                                    <div class="input-group pb-3 mt-3">
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

                                        @error('user')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="input-group pb-3 mb-3">
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

                                <p class="mt-4 mb-0 text-center">
                                    <a href="forgot-password.html">
                                        ¿Olvidaste tu contraseña?
                                    </a>
                                </p>

                            </div>
                        </div>

                        @if (session()->has('flash'))
                            <div class="alert alert-danger text-center mt-3" role="alert">
                                <i class="fas fa-info-circle mr-2"></i>
                                {{ session('flash') }}
                            </div>
                        @endif
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

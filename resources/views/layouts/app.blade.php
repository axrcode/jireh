<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--    Icono de la Aplicación      -->
    <link rel="icon" type="image/x-icon" href="/system/logo/favicon.png" />

    <!--    CSRF Token                  -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--    CSS - Bootstrap y Propios   -->
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">

    <!--    Head para cada Plantilla    -->
    @yield('head')

    <!--    Livewire Style              -->
    @livewireStyles()

    <!--    Headers para eliminar el Control Cache en Formularios    -->
    @php
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    @endphp

</head>
<body class="hold-transition sidebar-mini layout-fixed @if (Request::url() == route('login.index')) login-page bg-login @endif"> {{--  pace-primary --}}

    <!--    Contenido de Plantillas    -->
    @yield('content')

    <script src="{{ secure_asset('js/app.js') }}"></script>

    <!--    Javascripts para cada Plantilla    -->
    @yield('scripts')

    <!--    Livewire Scripts                    -->
    @livewireScripts

</body>
</html>

<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4 bg-drawer">

    <!-- Brand Logo -->
    <div class="d-block bg-brand-drawer text-center">
        <a href="{{ route('dashboard') }}">
            <img
                src="{{ $empresa->logo }}"
                alt="AdminLTE Logo"
                class="img-size-60"
                style="filter: hue-rotate(60deg) brightness(500%)"
            >
        </a>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image mt-2">
                <img src="/img/user.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info mt-n1">
                <a href="#" class="d-block text-truncate text-white">
                    {{ auth()->user()->name }}
                </a>
                <span class="text-white-50 text-truncate">
                    {{ auth()->user()->roles()->first()->name }}
                </span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat text-sm" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Opciones de Administrador -->
                @include('layouts.options_admin')

                <!-- Opciones de Estudiante -->
                @include('layouts.options_estudiante')

                <!-- Opciones de Docente -->
                @include('layouts.options_docente')

            </ul>
        </nav>

    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf

        <div class="sidebar-custom">

            <a href="" class="btn btn-link text-light mt-n1">
                <i class="fas fa-cogs"></i>
            </a>

            <button type="submit"
                class="btn btn-danger btn-sm btn-flat pos-right px-3 mr-2">
                <i class="fas fa-sign-out-alt"></i>
                {{ __('Logout') }}
            </button>

        </div>
    </form>
</aside>

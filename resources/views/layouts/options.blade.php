<!-- Opciones de Administrador -->

    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Tablero</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('admin.clientes.index') }}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Clientes</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('admin.pedidos.index') }}" class="nav-link">
            <i class="nav-icon fas fa-cart-arrow-down"></i>
            <p>Pedidos</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fas fa-cogs nav-icon"></i>
            <p>
                {{ __('Settings') }}
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>


            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.configuracion.generales') }}" class="nav-link">
                        <i class="fas fa-sliders-h nav-icon"></i>
                        <p>{{ __('General Parameters') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.configuracion.generales') }}" class="nav-link">
                        <i class="fas fa-user nav-icon"></i>
                        <p>Empleados</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.configuracion.generales') }}" class="nav-link">
                        <i class="fas fa-sitemap nav-icon"></i>
                        <p>Departamentos</p>
                    </a>
                </li>
            </ul>

    </li>

    {{-- <li class="nav-item">
        <a href="{{ route('admin.colaborador.index') }}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
                {{ __('Collaborators') }}
            </p>
        </a>
    </li>



    <li class="nav-item">
        <a href="{{ route('admin.estudiante.index') }}" class="nav-link">
            <i class="nav-icon fas fa-user-graduate"></i>
            <p>
                {{ __('Students') }}
            </p>
        </a>
    </li>



    <li class="nav-item">
        <a href="{{ route('admin.grado.index') }}" class="nav-link">
            <i class="nav-icon fas fa-th-list"></i>
            <p>
                {{ __('Grade') }}
            </p>
        </a>
    </li>



    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fas fa-file-signature nav-icon"></i>
            <p>
                {{ __('Inscriptions') }}
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>


            <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{ route('admin.inscripcion.codigo.create') }}" class="nav-link">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>
                                {{ __('Codes') }}
                            </p>
                        </a>
                    </li>


                <li class="nav-item">
                    <a href="{{ route('admin.inscripcion.codigo.create') }}" class="nav-link">
                        <i class="nav-icon fas fa-lock"></i>
                        <p>
                            {{ __('Inscribed') }}
                        </p>
                    </a>
                </li>
            </ul>

    </li> --}}


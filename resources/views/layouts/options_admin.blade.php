<!-- Opciones de Administrador -->
@can('admin.configuracion.generales')
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fas fa-cogs nav-icon"></i>
            <p>
                {{ __('Settings') }}
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>

        @can('admin.configuracion.generales')
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.configuracion.generales') }}" class="nav-link">
                        <i class="fas fa-sliders-h nav-icon"></i>
                        <p>{{ __('General Parameters') }}</p>
                    </a>
                </li>
            </ul>
        @endcan
    </li>
@endcan

@can('admin.dashboard')
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                {{ __('Dashboard') }}
            </p>
        </a>
    </li>
@endcan

@can('admin.colaborador.index')
    <li class="nav-item">
        <a href="{{ route('admin.colaborador.index') }}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
                {{ __('Collaborators') }}
            </p>
        </a>
    </li>
@endcan

@can('admin.estudiante.index')
    <li class="nav-item">
        <a href="{{ route('admin.estudiante.index') }}" class="nav-link">
            <i class="nav-icon fas fa-user-graduate"></i>
            <p>
                {{ __('Students') }}
            </p>
        </a>
    </li>
@endcan

@can('admin.grado.index')
    <li class="nav-item">
        <a href="{{ route('admin.grado.index') }}" class="nav-link">
            <i class="nav-icon fas fa-th-list"></i>
            <p>
                {{ __('Grade') }}
            </p>
        </a>
    </li>
@endcan

@can('admin.inscripcion.codigo.index')
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fas fa-file-signature nav-icon"></i>
            <p>
                {{ __('Inscriptions') }}
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>

        @can('admin.inscripcion.codigo.index')
            <ul class="nav nav-treeview">
                @can('admin.inscripcion.codigo.create')
                    <li class="nav-item">
                        <a href="{{ route('admin.inscripcion.codigo.create') }}" class="nav-link">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>
                                {{ __('Codes') }}
                            </p>
                        </a>
                    </li>
                @endcan

                <li class="nav-item">
                    <a href="{{ route('admin.inscripcion.codigo.create') }}" class="nav-link">
                        <i class="nav-icon fas fa-lock"></i>
                        <p>
                            {{ __('Inscribed') }}
                        </p>
                    </a>
                </li>
            </ul>
        @endcan
    </li>
@endcan

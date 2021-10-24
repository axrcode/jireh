<!-- Opciones de Docente -->
@can('docente.dashboard')
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                {{ __('Dashboard') }}
            </p>
        </a>
    </li>
@endcan

@can('docente.curso.index')
    <li class="nav-item">
        <a href="{{ route('docente.curso.index') }}" class="nav-link">
            <i class="nav-icon fas fa-book-open"></i>
            <p>
                {{ __('Courses') }}
            </p>
        </a>
    </li>
@endcan

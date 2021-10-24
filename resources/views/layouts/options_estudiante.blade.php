<!-- Opciones de Estudiante -->
@can('estudiante.dashboard')
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                {{ __('Dashboard') }}
            </p>
        </a>
    </li>
@endcan

@can('estudiante.curso.index')
    <li class="nav-item">
        <a href="{{ route('estudiante.curso.index') }}" class="nav-link">
            <i class="nav-icon fas fa-book-open"></i>
            <p>
                {{ __('My Courses') }}
            </p>
        </a>
    </li>
@endcan

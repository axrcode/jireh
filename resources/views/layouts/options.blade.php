<!-- Opciones de Administrador -->

    @can('admin/dashboard')
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Tablero</p>
        </a>
    </li>
    @endcan

    @can('admin/departamentos')
    <li class="nav-item">
        <a href="{{ route('admin.departamentos.index') }}" class="nav-link">
            <i class="nav-icon fas fa-sitemap nav-icon"></i>
            <p>Departamentos</p>
        </a>
    </li>
    @endcan

    @can('admin/empleados')
    <li class="nav-item">
        <a href="{{ route('admin.empleados.index') }}" class="nav-link">
            <i class="nav-icon fas fa-user nav-icon"></i>
            <p>Empleados</p>
        </a>
    </li>
    @endcan

    @can('admin/clientes')
    <li class="nav-item">
        <a href="{{ route('admin.clientes.index') }}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Clientes</p>
        </a>
    </li>
    @endcan

    @can('admin/pedidos')
    <li class="nav-item">
        <a href="{{ route('admin.pedidos.index') }}" class="nav-link">
            <i class="nav-icon fas fa-cart-arrow-down"></i>
            <p>Pedidos</p>
        </a>
    </li>
    @endcan

    @can('admin/proceso-pedidos')
    <li class="nav-item">
        <a href="{{ route('admin.procesos.index') }}" class="nav-link">
            <i class="nav-icon fas fa-hourglass-start"></i>
            <p>Proceso de Pedidos</p>
        </a>
    </li>
    @endcan

    @can('admin/reporte/pedidos')
    <li class="nav-item">
        <a href="{{ route('admin.reporte.pedidos') }}" class="nav-link">
            <i class="nav-icon fas fa-chart-bar"></i>
            <p>Reporte Pedidos</p>
        </a>
    </li>
    @endcan

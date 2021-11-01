<div class="row">

    <div class="col-12">
        <div class="card shadow-none">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="titulo">Fecha Inicial</label>
                            <input
                                class="form-control"
                                wire:model="fecha_inicio"
                                type="date"
                            >
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="titulo">Fecha Final</label>
                            <input
                                class="form-control"
                                wire:model="fecha_fin"
                                type="date"
                            >
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select
                                class="form-control"
                                wire:model="estado">
                                <option value="Todos">Todos</option>
                                <option value="Solicitado">Solicitado</option>
                                <option value="Despachado">Despachados</option>
                                <option value="En Proceso">En Proceso</option>
                                <option value="Terminado">Terminados</option>
                                <option value="Entregado">Entregado</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="titulo">Buscar</label>
                            <input
                                class="form-control"
                                wire:model="search"
                                type="text"
                                placeholder="Buscar una palabra clave..."
                            >
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-primary btn-flat btn-sm px-3" wire:click='limpiar()'>
                            Limpiar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card shadow-none">
            <div class="card-body px-3">

                @if ( $pedidos->count() )
                    @foreach ($pedidos as $pedido)
                        <div class="card">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-7">
                                        <h4 class="font-weight-bold">
                                            {{ $pedido->titulo }}
                                        </h4>
                                        <h5 class="font-weight-bold text-primary">
                                            {{ $pedido->cliente->nombre }} {{ $pedido->cliente->apellido }}
                                        </h5>
                                        <p class="my-0">
                                            {{ $pedido->descripcion == null ? 'Sin descripción' : $pedido->descripcion }}
                                        </p>
                                        <p class="my-0 text-muted">
                                            <b>Fecha del Pedido:</b>
                                            {{ date('d-m-Y', strtotime($pedido->fecha_pedido)) }}
                                        </p>
                                        <p class="mt-3 mb-0">
                                            <a  href="{{ route('admin.pedidos.show', [$pedido->id]) }}"
                                                class="btn btn-secondary btn-flat btn-sm px-3">
                                                Ver Ficha
                                            </a>
                                        </p>
                                    </div>

                                    <div class="col-md-1 py-0 px-1">
                                        <button class="btn btn-flat btn-link text-decoration-none p-0 h-100 w-100">
                                            <div class="card h-100">
                                                <div class="card-body {{ $pedido->fecha_solicitado != null ? 'bg-state-red' : 'bg-light text-muted' }} px-0">
                                                    <h4>
                                                        <i class="fas {{ $pedido->fecha_solicitado != null ? 'fa-check-circle' : 'fa-circle' }}"></i>
                                                    </h4>
                                                    <span class="badge {{ $pedido->fecha_solicitado != null ? 'bg-danger' : 'bg-secondary' }}">
                                                        {{ $pedido->fecha_solicitado != null ? 'Solicitado' : 'Pendiente' }}
                                                    </span>
                                                    <p class="m-0 small font-weight-bold pt-2">
                                                        {{ $pedido->fecha_solicitado != null ? date('d/m/Y', strtotime($pedido->fecha_solicitado)) : '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </button>
                                    </div>

                                    <div class="col-md-1 py-0 px-1">
                                        <button class="btn btn-flat btn-link text-decoration-none p-0 h-100 w-100">
                                            <div class="card h-100">
                                                <div class="card-body {{ $pedido->fecha_despachado != null ? 'bg-state-orange' : 'bg-light text-muted' }} px-0">
                                                    <h4>
                                                        <i class="fas {{ $pedido->fecha_despachado != null ? 'fa-check-circle' : 'fa-circle' }}"></i>
                                                    </h4>
                                                    <span class="badge {{ $pedido->fecha_despachado != null ? 'bg-orange' : 'bg-secondary' }}">
                                                        {{ $pedido->fecha_despachado != null ? 'Despachado' : 'Pendiente' }}
                                                    </span>
                                                    <p class="m-0 small font-weight-bold pt-2">
                                                        {{ $pedido->fecha_despachado != null ? date('d/m/Y', strtotime($pedido->fecha_despachado)) : '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </button>
                                    </div>

                                    <div class="col-md-1 py-0 px-1">
                                        <button class="btn btn-flat btn-link text-decoration-none p-0 h-100 w-100">
                                            <div class="card h-100">
                                                <div class="card-body {{ $pedido->fecha_proceso != null ? 'bg-state-yellow' : 'bg-light text-muted' }} px-0">
                                                    <h4>
                                                        <i class="fas {{ $pedido->fecha_proceso != null ? 'fa-check-circle' : 'fa-circle' }}"></i>
                                                    </h4>
                                                    <span class="badge {{ $pedido->fecha_proceso != null ? 'bg-warning' : 'bg-secondary' }}">
                                                        {{ $pedido->fecha_proceso != null ? 'En Proceso' : 'Pendiente' }}
                                                    </span>
                                                    <p class="m-0 small font-weight-bold pt-2">
                                                        {{ $pedido->fecha_proceso != null ? date('d/m/Y', strtotime($pedido->fecha_proceso)) : '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </button>
                                    </div>

                                    <div class="col-md-1 py-0 px-1">
                                        <button class="btn btn-flat btn-link text-decoration-none p-0 h-100 w-100">
                                            <div class="card h-100">
                                                <div class="card-body {{ $pedido->fecha_terminado != null ? 'bg-state-green' : 'bg-light text-muted' }} px-0">
                                                    <h4>
                                                        <i class="fas {{ $pedido->fecha_terminado != null ? 'fa-check-circle' : 'fa-circle' }}"></i>
                                                    </h4>
                                                    <span class="badge {{ $pedido->fecha_terminado != null ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ $pedido->fecha_terminado != null ? 'Terminado' : 'Pendiente' }}
                                                    </span>
                                                    <p class="m-0 small font-weight-bold pt-2">
                                                        {{ $pedido->fecha_terminado != null ? date('d/m/Y', strtotime($pedido->fecha_terminado)) : '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </button>
                                    </div>

                                    <div class="col-md-1 py-0 px-1">
                                        <button class="btn btn-flat btn-link text-decoration-none p-0 h-100 w-100">
                                            <div class="card h-100">
                                                <div class="card-body {{ $pedido->fecha_entregado != null ? 'bg-state-blue' : 'bg-light text-muted' }} px-0">
                                                    <h4>
                                                        <i class="fas {{ $pedido->fecha_entregado != null ? 'fa-check-circle' : 'fa-circle' }}"></i>
                                                    </h4>
                                                    <span class="badge {{ $pedido->fecha_entregado != null ? 'bg-primary' : 'bg-secondary' }}">
                                                        {{ $pedido->fecha_entregado != null ? 'Entregado' : 'Pendiente' }}
                                                    </span>
                                                    <p class="m-0 small font-weight-bold pt-2">
                                                        {{ $pedido->fecha_entregado != null ? date('d/m/Y', strtotime($pedido->fecha_entregado)) : '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 py-4 text-center">
                        <h4><i class="fas fa-times-circle"></i></h4>
                        <h4>No se encontró ningun registro</h4>
                    </div>
                @endif

                <div class="col-12">
                    {{ $pedidos->links() }}
                </div>
            </div>
        </div>
    </div>

</div>



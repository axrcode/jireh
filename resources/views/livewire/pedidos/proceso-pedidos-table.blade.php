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
                                                        Solicitado
                                                    </span>
                                                    <p class="m-0 small font-weight-bold pt-2">
                                                        {{ $pedido->fecha_solicitado != null ? date('d/m/Y', strtotime($pedido->fecha_solicitado)) : '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </button>
                                    </div>

                                    <div class="col-md-1 py-0 px-1">
                                        <button class="btn btn-flat btn-link text-decoration-none p-0 h-100 w-100"
                                            @can('admin/proceso-pedidos/despachado') data-toggle="modal" data-target="#estadoDespachado_{{ $pedido->id }}" @endcan>
                                            <div class="card h-100">
                                                <div class="card-body {{ $pedido->fecha_despachado != null ? 'bg-state-orange' : 'bg-light text-muted' }} px-0">
                                                    <h4>
                                                        <i class="fas {{ $pedido->fecha_despachado != null ? 'fa-check-circle' : 'fa-circle' }}"></i>
                                                    </h4>
                                                    <span class="badge {{ $pedido->fecha_despachado != null ? 'bg-orange' : 'bg-secondary' }}">
                                                        Despachado
                                                    </span>
                                                    <p class="m-0 small font-weight-bold pt-2">
                                                        {{ $pedido->fecha_despachado != null ? date('d/m/Y', strtotime($pedido->fecha_despachado)) : '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </button>
                                    </div>

                                    <!-- Modal cambiar estado a Despachado -->
                                    @can('admin/proceso-pedidos/despachado')
                                    <div class="modal fade" id="estadoDespachado_{{ $pedido->id }}" tabindex="-1" aria-labelledby="estadoDespachado" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cambiar Estado</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-wrap">
                                                    @if ( $pedido->estado == 'Solicitado' )
                                                        ¿ Cambiar el estado del pedido {{ $pedido->titulo }} a <b>'Despachado'</b> ?
                                                    @elseif ( $pedido->estado == 'Despachado')
                                                        ¿ Cambiar el estado del pedido {{ $pedido->titulo }} a <b>'Solicitado'</b> ?
                                                        @else
                                                            No se puede cambiar el estado del pedido a <b>'Despachado'</b> debido a que su estado actual es <b>'{{ $pedido->estado }}'</b>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light btn-flat btn-sm" data-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-primary btn-flat btn-sm" data-dismiss="modal"
                                                        wire:click="despachado({{$pedido->id}})">
                                                        Confirmar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endcan

                                    <div class="col-md-1 py-0 px-1">
                                        <button class="btn btn-flat btn-link text-decoration-none p-0 h-100 w-100"
                                            @can('admin/proceso-pedidos/proceso') data-toggle="modal" data-target="#estadoProceso_{{ $pedido->id }}" @endcan>
                                            <div class="card h-100">
                                                <div class="card-body {{ $pedido->fecha_proceso != null ? 'bg-state-yellow' : 'bg-light text-muted' }} px-0">
                                                    <h4>
                                                        <i class="fas {{ $pedido->fecha_proceso != null ? 'fa-check-circle' : 'fa-circle' }}"></i>
                                                    </h4>
                                                    <span class="badge {{ $pedido->fecha_proceso != null ? 'bg-warning' : 'bg-secondary' }}">
                                                        En Proceso
                                                    </span>
                                                    <p class="m-0 small font-weight-bold pt-2">
                                                        {{ $pedido->fecha_proceso != null ? date('d/m/Y', strtotime($pedido->fecha_proceso)) : '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </button>
                                    </div>

                                    @can('admin/proceso-pedidos/proceso')
                                    <!-- Modal cambiar estado a En Proceso -->
                                    <div class="modal fade" id="estadoProceso_{{ $pedido->id }}" tabindex="-1" aria-labelledby="estadoProceso" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cambiar Estado</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-wrap">
                                                    @if ( $pedido->estado == 'Despachado' )
                                                        ¿ Cambiar el estado del pedido {{ $pedido->titulo }} a <b>'En Proceso'</b> ?
                                                    @elseif ( $pedido->estado == 'En Proceso' )
                                                        ¿ Cambiar el estado del pedido {{ $pedido->titulo }} a <b>'Despachado'</b> ?
                                                        @else
                                                            No se puede cambiar el estado del pedido a <b>'En Proceso'</b> debido a que su estado actual es <b>'{{ $pedido->estado }}'</b>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light btn-flat btn-sm" data-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-primary btn-flat btn-sm" data-dismiss="modal"
                                                        wire:click="enProceso({{$pedido->id}})">
                                                        Confirmar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endcan

                                    <div class="col-md-1 py-0 px-1">
                                        <button class="btn btn-flat btn-link text-decoration-none p-0 h-100 w-100"
                                            @can('admin/proceso-pedidos/terminado') data-toggle="modal" data-target="#estadoTerminado_{{ $pedido->id }}" @endcan>
                                            <div class="card h-100">
                                                <div class="card-body {{ $pedido->fecha_terminado != null ? 'bg-state-green' : 'bg-light text-muted' }} px-0">
                                                    <h4>
                                                        <i class="fas {{ $pedido->fecha_terminado != null ? 'fa-check-circle' : 'fa-circle' }}"></i>
                                                    </h4>
                                                    <span class="badge {{ $pedido->fecha_terminado != null ? 'bg-success' : 'bg-secondary' }}">
                                                        Terminado
                                                    </span>
                                                    <p class="m-0 small font-weight-bold pt-2">
                                                        {{ $pedido->fecha_terminado != null ? date('d/m/Y', strtotime($pedido->fecha_terminado)) : '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </button>
                                    </div>

                                    <!-- Modal cambiar estado a Terminado -->
                                    @can('admin/proceso-pedidos/terminado')
                                    <div class="modal fade" id="estadoTerminado_{{ $pedido->id }}" tabindex="-1" aria-labelledby="estadoTerminado" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cambiar Estado</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-wrap">
                                                    @if ( $pedido->estado == 'En Proceso' )
                                                        ¿ Cambiar el estado del pedido {{ $pedido->titulo }} a <b>'Terminado'</b> ?
                                                    @elseif ( $pedido->estado == 'Terminado' )
                                                        ¿ Cambiar el estado del pedido {{ $pedido->titulo }} a <b>'En Proceso'</b> ?
                                                    @else
                                                        No se puede cambiar el estado del pedido a <b>'Terminado'</b> debido a que su estado actual es <b>'{{ $pedido->estado }}'</b>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light btn-flat btn-sm" data-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-primary btn-flat btn-sm" data-dismiss="modal"
                                                        wire:click="terminado({{$pedido->id}})">
                                                        Confirmar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endcan

                                    <div class="col-md-1 py-0 px-1">
                                        <button class="btn btn-flat btn-link text-decoration-none p-0 h-100 w-100"
                                         @can('admin/proceso-pedidos/entregado') data-toggle="modal" data-target="#estadoEntregado_{{ $pedido->id }}" @endcan>
                                            <div class="card h-100">
                                                <div class="card-body {{ $pedido->fecha_entregado != null ? 'bg-state-blue' : 'bg-light text-muted' }} px-0">
                                                    <h4>
                                                        <i class="fas {{ $pedido->fecha_entregado != null ? 'fa-check-circle' : 'fa-circle' }}"></i>
                                                    </h4>
                                                    <span class="badge {{ $pedido->fecha_entregado != null ? 'bg-primary' : 'bg-secondary' }}">
                                                        Entregado
                                                    </span>
                                                    <p class="m-0 small font-weight-bold pt-2">
                                                        {{ $pedido->fecha_entregado != null ? date('d/m/Y', strtotime($pedido->fecha_entregado)) : '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </button>
                                    </div>

                                    <!-- Modal cambiar estado a Entregado -->
                                    @can('admin/proceso-pedidos/entregado')
                                    <div class="modal fade" id="estadoEntregado_{{ $pedido->id }}" tabindex="-1" aria-labelledby="estadoEntregado" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cambiar Estado</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-wrap">
                                                    @if ( $pedido->estado == 'Terminado' )
                                                        ¿ Cambiar el estado del pedido {{ $pedido->titulo }} a <b>'Entregado'</b> ?
                                                    @elseif ( $pedido->estado == 'Entregado' )
                                                        ¿ Cambiar el estado del pedido {{ $pedido->titulo }} a <b>'Terminado'</b> ?
                                                    @else
                                                        No se puede cambiar el estado del pedido a <b>'Entregado'</b> debido a que su estado actual es <b>'{{ $pedido->estado }}'</b>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light btn-flat btn-sm" data-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-primary btn-flat btn-sm" data-dismiss="modal"
                                                        wire:click="entregado({{$pedido->id}})">
                                                        Confirmar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endcan

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



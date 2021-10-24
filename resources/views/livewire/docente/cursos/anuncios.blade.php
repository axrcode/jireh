@if ( $anuncios == 'none' )

    <div class="card shadow-none">
        <div class="card-body">
            <div class="p-3">
                <div class="alert alert-light shadow-sm border text-center m-0" role="alert">
                    No se han creado anuncios
                </div>
            </div>
        </div>
    </div>

@else

    @foreach ($anuncios as $anuncio)
        <div class="card shadow-none">
            <div class="card-header pb-0 bg-white border-0">

                @if ( $anuncio->destacado == true )
                    <div class="card-title bg-warning px-3 py-2 mt-n4 shadow-sm">
                        <i class="fas fa-star"></i>
                    </div>
                @endif

                <div class="card-tools">
                    <div class="btn-group">
                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu">

                            <a  href="{{ route('docente.curso.anuncios.show', [$curso, $anuncio->id]) }}"
                                class="dropdown-item">
                                Detalle
                            </a>

                            <a  href="{{ route('docente.curso.anuncios.edit', [$curso, $anuncio->id]) }}"
                                class="dropdown-item">
                                Editar
                            </a>

                            <form action="{{ route('docente.curso.anuncios.update.destacado', [$curso, $anuncio->id]) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    @if ( $anuncio->destacado == false )
                                        Marcar como destacado
                                    @else
                                        Desmarcar como destacado
                                    @endif
                                </button>
                            </form>

                            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete_anuncio_{{ $anuncio->id }}">
                                Eliminar
                            </button>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body pt-0">
                <div class="row">

                    <div class="col-12">
                        <a  href="{{ route('docente.curso.anuncios.show', [$curso, $anuncio->id]) }}"
                            class="text-dark text-decoration-none">
                            <h3>{{ $anuncio->titulo }}</h3>
                        </a>

                        <span class="text-muted">Martes 25 de junio de 2021</span>
                        <p>
                            {{ $anuncio->descripcion }}
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal para eliminar anuncio -->
        <div class="modal fade" id="delete_anuncio_{{ $anuncio->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <i class="fas fa-trash mr-2"></i>
                            Eliminar Anuncio
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Desea eliminar el anuncio
                        <b>{{ $anuncio->titulo }}</b>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-flat" data-dismiss="modal">Cancelar</button>
                        <form action="{{ route('docente.curso.anuncios.destroy', [$curso, $anuncio->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-flat">Confirmar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="mx-auto">
        {{ $anuncios->links() }}
    </div>

@endif

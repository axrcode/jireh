@extends('admin.configuracion.base')

@section('configuraciones')

    <div class="card shadow-none">

        <div class="card-header pb-0 bg-white">
            <p class="card-title font-weight-bold">
                {{ __('General Parameters') }}
            </p>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.configuracion.generales.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
                    <input type="hidden" name="academico_actual_id" value="{{ $academico_actual->id }}">

                    <div class="col-12">
                        <div class="form-group">
                            <label for="nombre">
                                {{ __('Name') }}
                            </label>

                            <input
                                type="text"
                                class="form-control form-control-border"
                                id="nombre"
                                name="nombre"
                                readonly
                                value="{{ $empresa->nombre }}"
                            >
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="direccion">
                                {{ __('Address') }}
                            </label>

                            <input
                                type="text"
                                class="form-control form-control-border @error('direccion') is-invalid @enderror"
                                id="direccion"
                                name="direccion"
                                placeholder="{{ trans('forms-general.address') }}"
                                required
                                autocomplete="off"
                                value="{{ $empresa->direccion }}"
                            >
                            @error('direccion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="telefono">
                                {{ __('Phone Number') }}
                            </label>

                            <input
                                type="text"
                                class="form-control form-control-border @error('telefono') is-invalid @enderror"
                                id="telefono"
                                name="telefono"
                                placeholder="{{ trans('forms-general.phone') }}"
                                required
                                data-inputmask='"mask": "9999-9999"' data-mask
                                autocomplete="off"
                                value="{{ $empresa->telefono }}"
                            >
                            @error('telefono')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="director">
                                {{ __('Principal') }}
                            </label>

                            <input
                                type="text"
                                class="form-control form-control-border @error('director') is-invalid @enderror"
                                id="director"
                                name="director"
                                placeholder="{{ trans('forms-general.address') }}"
                                required
                                autocomplete="off"
                                value="{{ $empresa->director }}"
                            >
                            @error('director')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="cicloescolar">
                                {{ __('Current School Cycle') }}
                            </label>

                            <select
                                name="cicloescolar"
                                id="cicloescolar"
                                class="form-control form-control-border"
                                required
                                autocomplete="off"
                            >
                                @foreach ($ciclos_escolares as $ciclo_escolar)
                                    <option
                                        value="{{ $ciclo_escolar->id }}"
                                        {{ $ciclo_escolar->id == $academico_actual->cicloescolar_id ? 'selected' : '' }}
                                    >
                                        {{ $ciclo_escolar->ciclo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="unidad">
                                {{ __('Current Unit') }}
                            </label>

                            <select
                                name="unidad"
                                id="unidad"
                                class="form-control form-control-border"
                                required
                                autocomplete="off"
                            >
                                @foreach ($unidades as $unidad)
                                    <option
                                        value="{{ $unidad->id }}"
                                        {{ $unidad->id == $academico_actual->unidad_id ? 'selected' : '' }}
                                    >
                                        {{ $unidad->unidad }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="cicloinscripciones">
                                Ciclo Escolar para Inscripciones
                            </label>

                            <select
                                name="cicloinscripciones"
                                id="cicloinscripciones"
                                class="form-control form-control-border"
                                required
                                autocomplete="off"
                            >
                                @foreach ($ciclos_escolares as $ciclo_escolar)
                                    <option
                                        value="{{ $ciclo_escolar->id }}"
                                        {{ $ciclo_escolar->id == $academico_actual->cicloinscripciones_id ? 'selected' : '' }}
                                    >
                                        {{ $ciclo_escolar->ciclo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="col-12 col-md-4 offset-md-8 px-0 mt-2">
                            <button type="submit" class="btn btn-success btn-block btn-flat">
                                <i class="fas fa-save mr-2"></i>
                                {{ __('Save Changes') }}
                            </button>
                        </div>
                    </div>

                </div>

            </form>

        </div>
    </div>

@endsection

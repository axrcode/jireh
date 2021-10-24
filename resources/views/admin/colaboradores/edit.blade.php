@extends('layouts.app')

@section('head')

    <title>{{ __('Edit Collaborator') }} - {{ config('app.name', 'Sistema') }}</title>

@endsection

@section('content')

<div class="wrapper">

    <!--    Navbar    -->
    @include('layouts.navbar')

    <!--    Main Sidebar Container    -->
    @include('layouts.drawer')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper text-sm">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="font-weight-bold m-0">
                            <i class="fas fa-users mr-1"></i>
                            {{ __('Edit Collaborator') }}
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.colaborador.index') }}">
                                    {{ __('Collaborators')}}
                                </a>
                            </li>
                            <li class="breadcrumb-item float-sm-right">
                                <a href="{{ route('admin.colaborador.show', [$colaborador->id]) }}">
                                    {{ $colaborador->user->name }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ __('Edit Collaborator') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <form action="{{ route('admin.colaborador.update', [$colaborador->id]) }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <!-- Card Personal Information -->
                        <div class="col-12">
                            <div class="card shadow-none">

                                <div class="card-header pb-1">
                                    <h5 class="font-weight-bold">
                                        {{ __('Personal Information') }}
                                    </h5>
                                </div>

                                <div class="card-body">
                                    <div class="row p-md-3">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nombre">
                                                    {{ __('Name') }}
                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control form-control-border @error('nombre') is-invalid @enderror"
                                                    id="nombre"
                                                    name="nombre"
                                                    placeholder="{{ trans('forms-collaborator.name') }}"
                                                    required
                                                    autocomplete="off"
                                                    value="{{ $colaborador->nombre }}"
                                                >
                                                @error('nombre')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="apellido">
                                                    {{ __('Last Name') }}
                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control form-control-border @error('apellido') is-invalid @enderror"
                                                    id="apellido"
                                                    name="apellido"
                                                    placeholder="{{ trans('forms-collaborator.last_name') }}"
                                                    required
                                                    autocomplete="off"
                                                    value="{{ $colaborador->apellido }}"
                                                >
                                                @error('apellido')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="fecha">
                                                    {{ __('Birthday') }}
                                                </label>

                                                <input
                                                    type="date"
                                                    class="form-control form-control-border @error('fecha') is-invalid @enderror"
                                                    id="fecha"
                                                    name="fecha"
                                                    placeholder="{{ trans('forms-collaborator.last_name') }}"
                                                    required
                                                    autocomplete="off"
                                                    value="{{ $colaborador->fecha_nacimiento }}"
                                                >
                                                @error('fecha')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="dpi">
                                                    {{ __('Identification Document') }}
                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control form-control-border"
                                                    id="dpi"
                                                    name="dpi"
                                                    placeholder="{{ trans('forms-collaborator.dpi') }}"
                                                    data-inputmask='"mask": "9999 99999 9999"' data-mask
                                                    autocomplete="off"
                                                    value="{{ $colaborador->dpi }}"
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="direccion">
                                                    {{ __('Address') }}
                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control form-control-border"
                                                    id="direccion"
                                                    name="direccion"
                                                    placeholder="{{ trans('forms-collaborator.address') }}"
                                                    autocomplete="off"
                                                    value="{{ $colaborador->direccion }}"
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="telefono">
                                                    {{ __('Phone Number') }}
                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control form-control-border @error('telefono') is-invalid @enderror"
                                                    id="telefono"
                                                    name="telefono"
                                                    placeholder="{{ trans('forms-collaborator.phone') }}"
                                                    required
                                                    autocomplete="off"
                                                    data-inputmask='"mask": "9999-9999"' data-mask
                                                    autocomplete="off"
                                                    value="{{ $colaborador->telefono }}"
                                                >
                                                @error('telefono')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="telefono_em">
                                                    {{ __('Emergency Phone Number') }}
                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control form-control-border"
                                                    id="telefono_em"
                                                    name="telefono_em"
                                                    placeholder="{{ trans('forms-collaborator.emergency_phone') }}"
                                                    data-inputmask='"mask": "9999-9999"' data-mask
                                                    autocomplete="off"
                                                    value="{{ $colaborador->telefono_emergencia }}"
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="email">
                                                    {{ __('E-Mail Address') }}
                                                </label>

                                                <input
                                                    type="email"
                                                    class="form-control form-control-border @error('email') is-invalid @enderror"
                                                    id="email"
                                                    name="email"
                                                    placeholder="{{ trans('forms-collaborator.email') }}"
                                                    required
                                                    autocomplete="off"
                                                    value="{{ $colaborador->email }}"
                                                >
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Card Institutional Information -->
                        <div class="col-12">
                            <div class="card shadow-none">

                                <div class="card-header pb-1">
                                    <h5 class="font-weight-bold">
                                        {{ __('Institutional Information') }}
                                    </h5>
                                </div>

                                <div class="card-body">
                                    <div class="row p-md-3">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="profesion">
                                                    {{ __('Profession') }}
                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control form-control-border"
                                                    id="profesion"
                                                    name="profesion"
                                                    placeholder="{{ trans('forms-collaborator.proffesion') }}"
                                                    autocomplete="off"
                                                    value="{{ $colaborador->profesion }}"
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="estudios">
                                                    {{ __('University Studies') }}
                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control form-control-border"
                                                    id="estudios"
                                                    name="estudios"
                                                    placeholder="{{ trans('forms-collaborator.university_studies') }}"
                                                    autocomplete="off"
                                                    value="{{ $colaborador->estudios }}"
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="universidad">
                                                    {{ __('University') }}
                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control form-control-border"
                                                    id="universidad"
                                                    name="universidad"
                                                    placeholder="{{ trans('forms-collaborator.university') }}"
                                                    autocomplete="off"
                                                    value="{{ $colaborador->universidad }}"
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="ultimo_anio">
                                                    {{ __('Last Year Studied') }}
                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control form-control-border"
                                                    id="ultimo_anio"
                                                    name="ultimo_anio"
                                                    placeholder="{{ trans('forms-collaborator.last_year_studied') }}"
                                                    data-inputmask='"mask": "9999"' data-mask
                                                    autocomplete="off"
                                                    value="{{ $colaborador->ultimo_anio_universidad }}"
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="cargo">
                                                    {{ __('Workstation') }}
                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control form-control-border"
                                                    id="cargo"
                                                    name="cargo"
                                                    placeholder="{{ trans('forms-collaborator.workstation') }}"
                                                    autocomplete="off"
                                                    value="{{ $colaborador->cargo }}"
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="usuario">
                                                    {{ __('Users Type') }}
                                                </label>

                                                <select
                                                    name="usuario"
                                                    id="usuario"
                                                    class="form-control form-control-border @error('usuario') is-invalid @enderror"
                                                    required
                                                    autocomplete="off"
                                                >
                                                    @foreach ($roles as $rol)
                                                        <option
                                                            value="{{ $rol->id }}"
                                                            {{ $rol->id == $colaborador->user->roles()->first()->id ? 'selected' : '' }}
                                                        >
                                                            {{ $rol->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('usuario')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="fecha_alta">
                                                    {{ __('Discharge Date') }}
                                                </label>

                                                <input
                                                    type="date"
                                                    class="form-control form-control-border"
                                                    id="fecha_alta"
                                                    name="fecha_alta"
                                                    placeholder="{{ trans('forms-collaborator.discharge_date') }}"
                                                    autocomplete="off"
                                                    value="{{ $colaborador->fecha_alta }}"
                                                >
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="offset-md-6 col-md-3 mb-3">
                            <a
                                href="{{ route('admin.colaborador.show', [$colaborador->id]) }}"
                                class="btn btn-secondary btn-block btn-flat">
                                <i class="fas fa-window-close mr-2"></i>
                                {{ __('Cancel') }}
                            </a>
                        </div>


                        <div class="col-md-3 mb-3">
                            <button
                                type="submit"
                                class="btn btn-success btn-block btn-flat">
                                <i class="fas fa-save mr-2"></i>
                                {{ __('Save Changes') }}
                            </button>
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- Control Sidebar -->
    @include('layouts.aside')

    <!-- Main Footer -->
    @include('layouts.footer')

</div>

@endsection

@section('scripts')

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('[data-mask]').inputmask()
    })
</script>

@endsection

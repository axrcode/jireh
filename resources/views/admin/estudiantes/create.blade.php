@extends('layouts.app')

@section('head')

    <title>{{ __('Create Student') }} - {{ config('app.name', 'Sistema') }}</title>

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
                            <i class="fas fa-user-graduate mr-1"></i>
                            {{ __('Create Student') }}
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.estudiante.index') }}">
                                    {{ __('Students')}}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ __('Create Student') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <form action="{{ route('admin.estudiante.store') }}" method="POST" novalidate>
                    @csrf

                    <div class="row">

                        <div class="col-md-6">

                            <!-- Card Student's Personal Information -->
                            <div class="card shadow-none">

                                <div class="card-header pb-1">
                                    <h5 class="font-weight-bold">
                                        {{ __('Personal Information') }}
                                    </h5>
                                </div>

                                <div class="card-body">
                                    <div class="row p-md-3">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nombre">
                                                    {{ __('Name') }}
                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control form-control-border @error('nombre') is-invalid @enderror"
                                                    id="nombre"
                                                    name="nombre"
                                                    placeholder="{{ trans('forms-students.name') }}"
                                                    required
                                                    autocomplete="off"
                                                    value="{{ old('nombre') }}"
                                                >
                                                @error('nombre')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="apellido">
                                                    {{ __('Last Name') }}
                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control form-control-border @error('apellido') is-invalid @enderror"
                                                    id="apellido"
                                                    name="apellido"
                                                    placeholder="{{ trans('forms-students.last_name') }}"
                                                    required
                                                    autocomplete="off"
                                                    value="{{ old('apellido') }}"
                                                >
                                                @error('apellido')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mineduc">
                                                    {{ __('Mineduc Code') }}
                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control form-control-border"
                                                    id="mineduc"
                                                    name="mineduc"
                                                    placeholder="{{ trans('forms-students.mineduc') }}"
                                                    data-inputmask='"mask": "#######"' data-mask
                                                    autocomplete="off"
                                                    value="{{ old('mineduc') }}"
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fecha">
                                                    {{ __('Birthday') }}
                                                </label>

                                                <input
                                                    type="date"
                                                    class="form-control form-control-border @error('fecha') is-invalid @enderror"
                                                    id="fecha"
                                                    name="fecha"
                                                    placeholder="{{ trans('forms-students.last_name') }}"
                                                    required
                                                    autocomplete="off"
                                                    value="{{ old('fecha') }}"
                                                >
                                                @error('fecha')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="genero">
                                                    {{ __('Gender') }}
                                                </label>

                                                <select
                                                    name="genero"
                                                    id="genero"
                                                    class="form-control form-control-border @error('genero') is-invalid @enderror"
                                                    required
                                                    autocomplete="off"
                                                    value="{{ old('usuario') }}"
                                                >
                                                    <option value="">{{ trans('forms-students.gender') }}</option>
                                                    <option value="Masculino">Masculino</option>
                                                    <option value="Femenino">Femenino</option>
                                                </select>

                                                @error('genero')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lateralidad">
                                                    {{ __('Laterality') }}
                                                </label>

                                                <select
                                                    name="lateralidad"
                                                    id="lateralidad"
                                                    class="form-control form-control-border @error('lateralidad') is-invalid @enderror"
                                                    required
                                                    autocomplete="off"
                                                    value="{{ old('lateralidad') }}"
                                                >
                                                    <option value="">{{ trans('forms-students.laterality') }}</option>
                                                    <option value="Diestro">Diestro</option>
                                                    <option value="Zurdo">Zurdo</option>
                                                </select>

                                                @error('lateralidad')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="direccion">
                                                    {{ __('Address') }}
                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control form-control-border"
                                                    id="direccion"
                                                    name="direccion"
                                                    placeholder="{{ trans('forms-students.address') }}"
                                                    autocomplete="off"
                                                    value="{{ old('direccion') }}"
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="telefono">
                                                    {{ __('Phone Number') }}
                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control form-control-border @error('telefono') is-invalid @enderror"
                                                    id="telefono"
                                                    name="telefono"
                                                    placeholder="{{ trans('forms-students.phone') }}"
                                                    required
                                                    autocomplete="off"
                                                    data-inputmask='"mask": "9999-9999"' data-mask
                                                    autocomplete="off"
                                                    value="{{ old('telefono') }}"
                                                >
                                                @error('telefono')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">
                                                    {{ __('E-Mail Address') }}
                                                </label>

                                                <input
                                                    type="email"
                                                    class="form-control form-control-border @error('email') is-invalid @enderror"
                                                    id="email"
                                                    name="email"
                                                    placeholder="{{ trans('forms-students.email') }}"
                                                    required
                                                    autocomplete="off"
                                                    value="{{ old('email') }}"
                                                >

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="alergia_medicamento">
                                                    Especifique si el estudiante es alergico a un medicamento
                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control form-control-border"
                                                    id="alergia_medicamento"
                                                    name="alergia_medicamento"
                                                    placeholder="Ingrese el nombre del medicamento"
                                                    autocomplete="off"
                                                    value="{{ old('alergia_medicamento') }}"
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="observacion">
                                                    Observaciones
                                                </label>

                                                <textarea
                                                    class="form-control form-control-border"
                                                    name="observacion"
                                                    id="observacion"
                                                    placeholder="Especifique alguna observación relacionada con el estudiante"
                                                    rows="2"
                                                ></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <!-- Card Student's Method Payment -->
                            <div class="card shadow-none">

                                <div class="card-header pb-1">
                                    <h5 class="font-weight-bold">
                                        {{ __('Method of Payment') }}
                                    </h5>
                                </div>

                                <div class="card-body">
                                    <div class="row p-md-3">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="metodo_pago">
                                                    {{ __('Method of Payment') }}
                                                </label>

                                                <select
                                                    name="metodo_pago"
                                                    id="metodo_pago"
                                                    class="form-control form-control-border"
                                                    required
                                                >
                                                    <option value="">Seleccione el método de pago</option>
                                                    <option value="Efectivo">Efectivo</option>
                                                    <option value="Depósito">Depósito</option>
                                                    <option value="Transferencia">Transferencia</option>
                                                    <option value="Cheque">Cheque</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_documento">
                                                    No. de Referencia Documento
                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control form-control-border"
                                                    id="no_documento"
                                                    name="no_documento"
                                                    placeholder="Ingrese el no. de referencia de documento"
                                                    autocomplete="off"
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="monto">
                                                    Monto
                                                </label>

                                                <input
                                                    type="number"
                                                    class="form-control form-control-border"
                                                    id="monto"
                                                    name="monto"
                                                    placeholder="Ingrese el monto cancelado"
                                                    autocomplete="off"
                                                >
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-6" id="accordion">

                            <!-- Card Father's Information -->
                            <div class="card shadow-none">
                                <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                    <div class="card-header pb-0">
                                        <h5 class="card-title text-dark font-weight-bold">
                                            {{ __("Father's Information") }}
                                        </h5>
                                    </div>
                                </a>
                                <div id="collapseOne" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row p-md-3">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="nombre_padre">
                                                        {{ __('Full Name') }}
                                                    </label>

                                                    <input
                                                        type="text"
                                                        class="form-control form-control-border"
                                                        id="nombre_padre"
                                                        name="nombre_padre"
                                                        placeholder="{{ trans('forms-students.name_father') }}"
                                                        autocomplete="off"
                                                        value="{{ old('nombre_padre') }}"
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="dpi_padre">
                                                        {{ __('Identification Document') }}
                                                    </label>

                                                    <input
                                                        type="text"
                                                        class="form-control form-control-border"
                                                        id="dpi_padre"
                                                        name="dpi_padre"
                                                        placeholder="{{ trans('forms-students.dpi_father') }}"
                                                        data-inputmask='"mask": "9999 99999 9999"' data-mask
                                                        autocomplete="off"
                                                        value="{{ old('dpi_padre') }}"
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="telefono_padre">
                                                        {{ __('Phone Number') }}
                                                    </label>

                                                    <input
                                                        type="text"
                                                        class="form-control form-control-border"
                                                        id="telefono_padre"
                                                        name="telefono_padre"
                                                        placeholder="{{ trans('forms-students.phone_father') }}"
                                                        data-inputmask='"mask": "9999-9999"' data-mask
                                                        autocomplete="off"
                                                        value="{{ old('telefono_padre') }}"
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="direccion_padre">
                                                        {{ __('Address') }}
                                                    </label>

                                                    <input
                                                        type="text"
                                                        class="form-control form-control-border"
                                                        id="direccion_padre"
                                                        name="direccion_padre"
                                                        placeholder="{{ trans('forms-students.address_father') }}"
                                                        autocomplete="off"
                                                        value="{{ old('direccion_padre') }}"
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="email_padre">
                                                        {{ __('E-Mail Address') }}
                                                    </label>

                                                    <input
                                                        type="email"
                                                        class="form-control form-control-border"
                                                        id="email_padre"
                                                        name="email_padre"
                                                        placeholder="{{ trans('forms-students.email_father') }}"
                                                        autocomplete="off"
                                                        value="{{ old('email_padre') }}"
                                                    >
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Mother's Information -->
                            <div class="card shadow-none">
                                <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                                    <div class="card-header pb-0">
                                        <h5 class="card-title text-dark font-weight-bold">
                                            {{ __("Mother's Information") }}
                                        </h5>
                                    </div>
                                </a>
                                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row p-md-3">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="nombre_madre">
                                                        {{ __('Full Name') }}
                                                    </label>

                                                    <input
                                                        type="text"
                                                        class="form-control form-control-border"
                                                        id="nombre_madre"
                                                        name="nombre_madre"
                                                        placeholder="{{ trans('forms-students.name_mother') }}"
                                                        autocomplete="off"
                                                        value="{{ old('nombre_madre') }}"
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="dpi_madre">
                                                        {{ __('Identification Document') }}
                                                    </label>

                                                    <input
                                                        type="text"
                                                        class="form-control form-control-border"
                                                        id="dpi_madre"
                                                        name="dpi_madre"
                                                        placeholder="{{ trans('forms-students.dpi_mother') }}"
                                                        data-inputmask='"mask": "9999 99999 9999"' data-mask
                                                        autocomplete="off"
                                                        value="{{ old('dpi_madre') }}"
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="telefono_madre">
                                                        {{ __('Phone Number') }}
                                                    </label>

                                                    <input
                                                        type="text"
                                                        class="form-control form-control-border"
                                                        id="telefono_madre"
                                                        name="telefono_madre"
                                                        placeholder="{{ trans('forms-students.phone_mother') }}"
                                                        data-inputmask='"mask": "9999-9999"' data-mask
                                                        autocomplete="off"
                                                        value="{{ old('telefono_madre') }}"
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="direccion_madre">
                                                        {{ __('Address') }}
                                                    </label>

                                                    <input
                                                        type="text"
                                                        class="form-control form-control-border"
                                                        id="direccion_madre"
                                                        name="direccion_madre"
                                                        placeholder="{{ trans('forms-students.address_mother') }}"
                                                        autocomplete="off"
                                                        value="{{ old('direccion_madre') }}"
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="email_madre">
                                                        {{ __('E-Mail Address') }}
                                                    </label>

                                                    <input
                                                        type="email"
                                                        class="form-control form-control-border"
                                                        id="email_madre"
                                                        name="email_madre"
                                                        placeholder="{{ trans('forms-students.email_mother') }}"
                                                        autocomplete="off"
                                                        value="{{ old('email_madre') }}"
                                                    >
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Other Tutor Information -->
                            <div class="card shadow-none">
                                <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                                    <div class="card-header pb-0">
                                        <h5 class="card-title text-dark font-weight-bold">
                                            {{ __("Tutor's Information") }}
                                        </h5>
                                    </div>
                                </a>
                                <div id="collapseThree" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row p-md-3">

                                            <div class="col-md-12 mb-3">
                                                <div class="callout callout-info bg-light">
                                                    <p>
                                                        {{ __('This section is used to provide the infomration of the guardian in charge of the student in case of not being the father/mother.') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="nombre_tutor">
                                                        {{ __('Full Name') }}
                                                    </label>

                                                    <input
                                                        type="text"
                                                        class="form-control form-control-border"
                                                        id="nombre_tutor"
                                                        name="nombre_tutor"
                                                        placeholder="{{ trans('forms-students.name_tutor') }}"
                                                        autocomplete="off"
                                                        value="{{ old('nombre_tutor') }}"
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="dpi_tutor">
                                                        {{ __('Identification Document') }}
                                                    </label>

                                                    <input
                                                        type="text"
                                                        class="form-control form-control-border"
                                                        id="dpi_tutor"
                                                        name="dpi_tutor"
                                                        placeholder="{{ trans('forms-students.dpi_tutor') }}"
                                                        data-inputmask='"mask": "9999 99999 9999"' data-mask
                                                        autocomplete="off"
                                                        value="{{ old('dpi_tutor') }}"
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="telefono_tutor">
                                                        {{ __('Phone Number') }}
                                                    </label>

                                                    <input
                                                        type="text"
                                                        class="form-control form-control-border"
                                                        id="telefono_tutor"
                                                        name="telefono_tutor"
                                                        placeholder="{{ trans('forms-students.phone_tutor') }}"
                                                        data-inputmask='"mask": "9999-9999"' data-mask
                                                        autocomplete="off"
                                                        value="{{ old('telefono_tutor') }}"
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="direccion_tutor">
                                                        {{ __('Address') }}
                                                    </label>

                                                    <input
                                                        type="text"
                                                        class="form-control form-control-border"
                                                        id="direccion_tutor"
                                                        name="direccion_tutor"
                                                        placeholder="{{ trans('forms-students.address_tutor') }}"
                                                        autocomplete="off"
                                                        value="{{ old('direccion_tutor') }}"
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="email_tutor">
                                                        {{ __('E-Mail Address') }}
                                                    </label>

                                                    <input
                                                        type="email"
                                                        class="form-control form-control-border"
                                                        id="email_tutor"
                                                        name="email_tutor"
                                                        placeholder="{{ trans('forms-students.email_tutor') }}"
                                                        autocomplete="off"
                                                        value="{{ old('email_tutor') }}"
                                                    >
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Información de Conexión a Internet para el Estudiante -->
                            <div class="card shadow-none">
                                <div class="card-header pb-0">
                                    <a class="d-block w-100" data-toggle="collapse" href="#conexion">
                                        <h5 class="card-title text-dark w-100 font-weight-bold">
                                            {{ __("Internet Connection") }}
                                        </h5>
                                    </a>
                                </div>
                                <div id="conexion" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row p-md-3">

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            name="conexion_internet"
                                                            id="conexion_internet"
                                                            value="1"
                                                            onchange="javascript:showContent()"
                                                        >

                                                        <label class="form-check-label">
                                                            ¿El estudiante posee conexión a internet en casa?
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12" id="info_conexion_internet" style="display: none;">
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="conexion_tipo">
                                                                Tipo de Conexión
                                                            </label>

                                                            <select
                                                                name="conexion_tipo"
                                                                id="conexion_tipo"
                                                                class="form-control form-control-border"
                                                            >
                                                                <option value="">Seleccione el tipo de conexión que posee</option>
                                                                <option value="Wifi">Wifi</option>
                                                                <option value="Datos">Datos</option>
                                                                <option value="No Posee">No Posee</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="conexion_velocidad">
                                                                Velocidad de la Conexión
                                                            </label>

                                                            <select
                                                                name="conexion_velocidad"
                                                                id="conexion_velocidad"
                                                                class="form-control form-control-border"
                                                            >
                                                                <option value="">Seleccione la velocidad de su conexión</option>
                                                                <option value="1 Mbps">1 Mbps</option>
                                                                <option value="5 Mbps">5 Mbps</option>
                                                                <option value="10 Mbps">10 Mbps</option>
                                                                <option value="12 Mbps">12 Mbps</option>
                                                                <option value="Mayor Conexión">Mayor Conexión</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            name="equipo"
                                                            id="equipo"
                                                            value="1"
                                                            onchange="javascript:showContent()"
                                                        >

                                                        <label class="form-check-label">
                                                            ¿El estudiante posee un dispositivo para conectarse?
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12" id="info_equipo" style="display: none;">
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="equipo_tipo">
                                                                Tipo de Dispositivo
                                                            </label>

                                                            <select
                                                                name="equipo_tipo"
                                                                id="equipo_tipo"
                                                                class="form-control form-control-border"
                                                            >
                                                                <option value="">Seleccion el tipo de dispositivo que posee</option>
                                                                <option value="Smartphone">Smartphone</option>
                                                                <option value="Computadora">Computadora</option>
                                                                <option value="Ambas">Ambas</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Buttons -->
                        <div class="offset-md-6 col-md-3 mb-3">
                            <a
                                href="{{ route('admin.estudiante.index') }}"
                                class="btn btn-secondary btn-block btn-flat">
                                <i class="fas fa-window-close mr-2"></i>
                                {{ __('Cancel') }}
                            </a>
                        </div>

                        <div class="col-md-3 mb-3">
                            <button
                                type="submit"
                                id="btnInscribir"
                                class="btn btn-success btn-block btn-flat"
                                onclick="javascript=this.disabled = true; form.submit();"
                                disabled
                            >
                                <i class="fas fa-save mr-2"></i>
                                {{ __('Save Student') }}
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

<script>
    function showContent()
    {
        element_conexion = document.getElementById("info_conexion_internet");
        check_conexion = document.getElementById("conexion_internet");

        if (check_conexion.checked) {
            element_conexion.style.display='block';
        }
        else {
            element_conexion.style.display='none';
        }

        element_equipo = document.getElementById("info_equipo");
        check_equipo = document.getElementById("equipo");

        if (check_equipo.checked) {
            element_equipo.style.display='block';
        }
        else {
            element_equipo.style.display='none';
        }
    }

    function habilitar()
    {
        nombre = document.getElementById('nombre').value;
        apellido = document.getElementById('apellido').value;
        fecha = document.getElementById('fecha').value;
        genero = document.getElementById('genero').value;
        telefono = document.getElementById('telefono').value;
        email = document.getElementById('email').value;
        contador = 0;

        if (nombre=="" || apellido=="" || fecha=="" || genero=="" || telefono=="" || email=="")
        {
            contador++;
        }

        contador == 0 ? document.getElementById('btnInscribir').disabled = false : document.getElementById('btnInscribir').disabled = true;
    }

    document.getElementById('nombre').addEventListener("keyup", habilitar);
    document.getElementById('apellido').addEventListener("keyup", habilitar);
    document.getElementById('fecha').addEventListener("keyup", habilitar);
    document.getElementById('genero').addEventListener("change", habilitar);
    document.getElementById('telefono').addEventListener("keyup", habilitar);
    document.getElementById('email').addEventListener("keyup", habilitar);
</script>

@endsection

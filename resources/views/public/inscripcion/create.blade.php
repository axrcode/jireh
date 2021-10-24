@extends('layouts.app')

@section('head')

    <title>{{ __('Inscripcion') }} - {{ config('app.name', 'Sistema') }}</title>

@endsection

@section('content')

<div class="px-4 encabezado-inscripciones">
    <div class="row text-center text-white vertical-center">

        <div class="col-6 col-md-2 mx-auto">
            <img src="{{ $empresa->logo }}" alt="Logo" class="w-100">
        </div>

        <div class="col-12 mb-5">
            <h1 class="font-weight-bold">
                Inscripciones {{ $academico_actual->cicloinscripciones->ciclo }}
            </h1>
        </div>

    </div>
</div>

<div class="bg-white">
    <div class="container">

        <form action="{{ route('public.inscripcion.store') }}" method="POST">
            @csrf

            <input type="hidden" value="{{ $codigo_inscripcion->id }}" name="codigo_inscripcion">

            <div class="row pt-5 pb-4">

                <div class="col-md-12 mb-3">
                    <div class="callout callout-info">
                        <h2>
                            <i class="fas fa-info-circle mr-1"></i>
                            {{ __('Note') }}
                        </h2>
                        <h5>
                            <ul>
                                <li>A continuación se le presenta el formulario correspondiente a la inscripción del estudiante.</li>
                                <li>Debe leer detenidamiente la información que se le solicita.</li>
                                <li>Algunos campos son de carácter obligatorio <b>(*)</b>, el sistema no le permitirá avanzar hasta que llene la información.</li>
                                <li>El número de télefono solicitado en el panel del estudiante servirá como contacto rápido para la institución.</li>
                                <li>El correo electrónico en el panel del estudiante servirá para enviar la confirmación de la inscripción.</li>
                            </ul>
                        </h5>
                    </div>
                </div>


                <div class="col-md-6">

                    <!-- Card Student's Personal Information -->
                    <div class="card card-primary shadow-none">

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
                                            (*)
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
                                            (*)
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
                                            (*)
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
                                            (*)
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
                                            (*)
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
                                            (*)
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
                                            data-inputmask='"mask": "#######"' data-mask
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

                    <!-- Card Información de Forma de Pago -->
                    <div class="card card-primary shadow-none">

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
                                            (*)
                                        </label>

                                        <select
                                            name="metodo_pago"
                                            id="metodo_pago"
                                            class="form-control form-control-border @error('metodo_pago') is-invalid @enderror"
                                            required
                                        >
                                            <option value="">Seleccione el método de pago</option>
                                            <option value="Efectivo">Efectivo</option>
                                            <option value="Depósito">Depósito</option>
                                            <option value="Transferencia">Transferencia</option>
                                            <option value="Cheque">Cheque</option>
                                        </select>

                                        @error('metodo_pago')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_documento">
                                            No. de Referencia Documento
                                            (*)
                                        </label>

                                        <input
                                            type="text"
                                            class="form-control form-control-border @error('no_documento') is-invalid @enderror"
                                            id="no_documento"
                                            name="no_documento"
                                            placeholder="Ingrese el no. de referencia de documento"
                                            required
                                            autocomplete="off"
                                        >
                                        @error('no_documento')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="monto">
                                            Monto
                                            (*)
                                        </label>

                                        <input
                                            type="number"
                                            class="form-control form-control-border @error('monto') is-invalid @enderror"
                                            id="monto"
                                            name="monto"
                                            placeholder="Ingrese el monto cancelado"
                                            required
                                            autocomplete="off"
                                        >
                                        @error('monto')
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

                <div class="col-md-6" id="accordion">

                    <!-- Card Información del Padre de Familia -->
                    <div class="card card-lightblue shadow-none">
                        <div class="card-header pb-0">
                            <a class="d-block w-100" data-toggle="collapse" href="#padre">
                                <h5 class="card-title w-100 font-weight-bold">
                                    {{ __("Father's Information") }}
                                </h5>
                            </a>
                        </div>
                        <div id="padre" class="collapse" data-parent="#accordion">
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

                    <!-- Card Información de la Madre de Familia -->
                    <div class="card card-maroon shadow-none">
                        <div class="card-header pb-0">
                            <a class="d-block w-100" data-toggle="collapse" href="#madre">
                                <h5 class="card-title w-100 font-weight-bold">
                                    {{ __("Mother's Information") }}
                                </h5>
                            </a>
                        </div>
                        <div id="madre" class="collapse" data-parent="#accordion">
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

                    <!-- Card Información de Tutor (No Padre/Madre de Familia) -->
                    <div class="card card-teal shadow-none">
                        <div class="card-header pb-0">
                            <a class="d-block w-100" data-toggle="collapse" href="#tutor">
                                <h5 class="card-title w-100 font-weight-bold">
                                    {{ __("Tutor's Information") }} o Contacto de Emergencia
                                </h5>
                            </a>
                        </div>
                        <div id="tutor" class="collapse" data-parent="#accordion">
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
                    <div class="card card-navy shadow-none">
                        <div class="card-header pb-0">
                            <a class="d-block w-100" data-toggle="collapse" href="#conexion">
                                <h5 class="card-title w-100 font-weight-bold">
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

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-12 col-md-3 ml-auto">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success btn-flat btn-block" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-arrow-circle-right mr-1"></i>
                        Continuar
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        <i class="fas fa-check-double mr-1"></i>
                                        <b>Confirmar Inscripción</b>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-left text-wrap">
                                        ¿Esta seguro que desea realizar el registro del estudiante?
                                        <span class="text-danger">Este proceso es irreversible</span>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary btn-flat" data-dismiss="modal">
                                        Cancelar
                                    </button>

                                    <button type="submit" class="btn btn-success btn-flat" id="btnInscribir" disabled
                                        onclick="javascript=this.disabled = true; form.submit();"
                                    >
                                        Confirmar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </form>
    </div>
</div>

<!-- Inicio Footer -->
<footer class="text-muted text-sm">
    <div class="px-3 px-md-5 py-3">
        <div class="float-md-right">
            Desarrollado por
            <a href="https://axrcode.me" class="text-decoration-none font-weight-bold text-secondary" target="_blank">
                axrcode
            </a>
        </div>
        <strong>
            Theme by.
            <a href="https://adminlte.io" target="_blank">AdminLTE</a>
        </strong>
        &copy; {{ date('Y') }} {{ $empresa->nombre }}
    </div>
</footer>
<!-- Fin Footer -->

@endsection

@section('scripts')

    @include('extensions.toast-process-result')

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
            metodo_pago = document.getElementById('metodo_pago').value;
            no_documento = document.getElementById('no_documento').value;
            monto = document.getElementById('monto').value;
            contador = 0;

            if (nombre=="" || apellido=="" || fecha=="" || genero=="" || telefono=="" || email=="" || metodo_pago=="" || no_documento=="" || monto=="")
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
        document.getElementById('metodo_pago').addEventListener("change", habilitar);
        document.getElementById('no_documento').addEventListener("keyup", habilitar);
        document.getElementById('monto').addEventListener("keyup", habilitar);
    </script>

@endsection


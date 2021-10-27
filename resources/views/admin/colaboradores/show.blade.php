@extends('layouts.app')

@section('head')

    <title>{{ $colaborador->user->name }} - {{ config('app.name', 'Sistema') }}</title>

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
                            {{ __('Collaborator File') }}
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.colaborador.index') }}">
                                    {{ __('Collaborators')}}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ $colaborador->user->name }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">

                    @if ( $empty_fields>0 )
                        <div class="col-12">
                            <div class="alert alert-warning alert-dismissible border-warning">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="icon fas fa-exclamation-triangle"></i>
                                Se encontraron <b>{{ $empty_fields }}</b> campo(s) incompleto(s)
                            </div>
                        </div>
                    @endif

                    <div class="col-12">
                        <div class="card shadow-none">
                            <div class="card-body">

                                <div class="row pl-0 pl-md-5 pt-3">
                                    <div class="col-10 mx-auto col-md-3 col-xl-2 mx-md-0 px-0">
                                        <img
                                            src="{{ $colaborador->fotografia }}"
                                            alt="Picture Collaborator"
                                            class="img-thumbnail w-100"
                                            onerror="this.src='/img/profile-default.jpg'"
                                        >
                                    </div>

                                    <div class="col-12 col-md-9 col-xl-10 px-4">
                                        <h1 class="font-weight-bold mt-4 mt-md-2">
                                            {{ $colaborador->nombre }} {{ $colaborador->apellido }}
                                        </h1>

                                        <dl class="row">
                                            <dt class="col-sm-3">
                                                {{ __('System Code') }}
                                            </dt>
                                            <dd class="col-sm-9">
                                                {{ $colaborador->id }}
                                            </dd>

                                            <dt class="col-sm-3">
                                                {{ __('Employee Code') }}
                                            </dt>
                                            <dd class="col-sm-9">
                                                {{ $colaborador->codigo_empleado }}
                                            </dd>

                                            <dt class="col-sm-3">
                                                {{ __('Users Type') }}
                                            </dt>
                                            <dd class="col-sm-9">
                                                {{ $colaborador->user->roles()->first()->name }}
                                            </dd>

                                            <dt class="col-sm-3">
                                                {{ __('Psychological Profile') }}
                                            </dt>
                                            <dd class="col-sm-9">
                                                <span class="h2 font-weight-bold">
                                                    {{ $colaborador->ps }}
                                                </span>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card shadow-none">
                            <div class="card-body px-3">
                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="col-12">
                                            <span class="font-weight-bold">
                                                {{ __('Modify') }}
                                            </span>
                                        </div>

                                        @can('admin.colaborador.edit')
                                            <div class="col-12">
                                                <a  href="{{ route('admin.colaborador.edit', [$colaborador->id]) }}"
                                                    class="text-dark">
                                                    {{ __('Edit Collaborator') }}
                                                </a>
                                            </div>
                                        @endcan

                                        @can('admin.foto')
                                            <div class="col-12">
                                                <a  href="{{ route('admin.foto.index', [$colaborador->user->id]) }}"
                                                    class="text-dark">
                                                    {{ __('Change Photo') }}
                                                </a>
                                            </div>
                                        @endcan

                                        @if ($colaborador->user->roles()->first()->name == 'Docente')
                                            <div class="col-12">
                                                <a  href="{{ route('admin.colaborador.cursos_index', [$colaborador->id]) }}"
                                                    class="text-dark">
                                                    {{ __('Show Courses') }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card shadow-none">

                            <div class="card-body px-3">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card shadow-none border-0">
                                            <div class="card-header bg-transparent pb-0">
                                                <h2 class="card-title">
                                                    <i class="fas fa-user-shield mr-2"></i>
                                                    {{ __('Personal Information') }}
                                                </h2>
                                            </div>

                                            <div class="card-body pb-0">
                                                <dl class="row mb-0">
                                                    <dt class="col-sm-5">
                                                        {{ __('Birthday') }}
                                                    </dt>
                                                    <dd class="col-sm-7">
                                                        {{ date("d-m-Y", strtotime($colaborador->fecha_nacimiento)) }}
                                                    </dd>

                                                    <dt class="col-sm-5">
                                                        {{ __('Identification Document') }}
                                                    </dt>
                                                    <dd class="col-sm-7">
                                                        @if ( empty($colaborador->dpi) ) {!! $empty_text !!} @else {{ $colaborador->dpi }} @endif
                                                    </dd>

                                                    <dt class="col-sm-5">
                                                        {{ __('Address') }}
                                                    </dt>
                                                    <dd class="col-sm-7">
                                                        @if ( empty($colaborador->direccion) ) {!! $empty_text !!} @else {{ $colaborador->direccion }} @endif
                                                    </dd>

                                                    <dt class="col-sm-5">
                                                        {{ __('Phone Number') }}
                                                    </dt>
                                                    <dd class="col-sm-7">
                                                        {{ $colaborador->telefono }}
                                                    </dd>

                                                    <dt class="col-sm-5">
                                                        {{ __('Emergency Phone Number') }}
                                                    </dt>
                                                    <dd class="col-sm-7">
                                                        @if ( empty($colaborador->telefono_emergencia) ) {!! $empty_text !!} @else {{ $colaborador->telefono_emergencia }} @endif
                                                    </dd>

                                                    <dt class="col-sm-5">
                                                        {{ __('E-Mail Address') }}
                                                    </dt>
                                                    <dd class="col-sm-7">
                                                        {{ $colaborador->email }}
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card shadow-none border-0">
                                            <div class="card-header bg-transparent pb-0">
                                                <h2 class="card-title">
                                                    <i class="fas fa-briefcase mr-2"></i>
                                                    {{ __('Institutional Information') }}
                                                </h2>
                                            </div>

                                            <div class="card-body pb-0">
                                                <dl class="row mb-0">
                                                    <dt class="col-sm-5">
                                                        {{ __('Profession') }}
                                                    </dt>
                                                    <dd class="col-sm-7">
                                                        @if ( empty($colaborador->profesion) ) {!! $empty_text !!} @else {{ $colaborador->profesion }} @endif
                                                    </dd>

                                                    <dt class="col-sm-5">
                                                        {{ __('University Studies') }}
                                                    </dt>
                                                    <dd class="col-sm-7">
                                                        @if ( empty($colaborador->estudios) ) {!! $empty_text !!} @else {{ $colaborador->estudios }} @endif
                                                    </dd>

                                                    <dt class="col-sm-5">
                                                        {{ __('University') }}
                                                    </dt>
                                                    <dd class="col-sm-7">
                                                        @if ( empty($colaborador->universidad) ) {!! $empty_text !!} @else {{ $colaborador->universidad }} @endif
                                                    </dd>

                                                    <dt class="col-sm-5">
                                                        {{ __('Last Year Studied') }}
                                                    </dt>
                                                    <dd class="col-sm-7">
                                                        @if ( empty($colaborador->ultimo_anio_universidad) ) {!! $empty_text !!} @else {{ $colaborador->ultimo_anio_universidad }} @endif
                                                    </dd>

                                                    <dt class="col-sm-5">
                                                        {{ __('Workstation') }}
                                                    </dt>
                                                    <dd class="col-sm-7">
                                                        @if ( empty($colaborador->cargo) ) {!! $empty_text !!} @else {{ $colaborador->cargo }} @endif
                                                    </dd>

                                                    <dt class="col-sm-5">
                                                        {{ __('Discharge Date') }}
                                                    </dt>
                                                    <dd class="col-sm-7">
                                                        @if ( empty($colaborador->fecha_alta) ) {!! $empty_text !!} @else {{ $colaborador->fecha_alta }} @endif
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>


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

    <script src="/scripts/colaboradores-datatable.js"></script>

    @include('extensions.toast-process-result')

@endsection

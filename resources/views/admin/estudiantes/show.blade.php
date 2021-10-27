@extends('layouts.app')

@section('head')

    <title>{{ $estudiante->user->name }} - {{ config('app.name', 'Sistema') }}</title>

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
                            {{ __('Student File') }}
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
                                {{ $estudiante->user->name }}
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

                    @if ( $empty_fields > 0 )
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
                                            src="{{ $estudiante->fotografia }}"
                                            alt="Picture Collaborator"
                                            class="img-thumbnail w-100"
                                            onerror="this.src='/img/profile-default.jpg'"
                                        >
                                    </div>

                                    <div class="col-12 col-md-9 col-xl-10 px-4">
                                        <h1 class="font-weight-bold mt-4 mt-md-2">
                                            {{ $estudiante->nombre }} {{ $estudiante->apellido }}
                                        </h1>

                                        <h4 class="text-muted">
                                            @php $asignacion_grado = $estudiante->asignacion_grado->where('cicloescolar_id', $academico_actual->cicloescolar_id)->first() @endphp

                                            @if ( empty($asignacion_grado) )
                                                <span class="text-danger">{{ __('Not Enrolled') }}</span>
                                            @else
                                                {{ $asignacion_grado->grado->nombre }}
                                            @endif
                                        </h4>

                                        <dl class="row">
                                            <dt class="col-sm-3">
                                                {{ __('System Code') }}
                                            </dt>
                                            <dd class="col-sm-9">
                                                {{ $estudiante->id }}
                                            </dd>

                                            <dt class="col-sm-3">
                                                {{ __('Mineduc Code') }}
                                            </dt>
                                            <dd class="col-sm-9">
                                                {{ $estudiante->codigo_mineduc }}
                                            </dd>

                                            <dt class="col-sm-3">
                                                {{ __('Psychological Profile') }}
                                            </dt>
                                            <dd class="col-sm-9">
                                                <span class="h2 font-weight-bold">
                                                    {{ $estudiante->ps }}
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

                                    <div class="col-md-4">
                                        <div class="col-12">
                                            <span class="font-weight-bold">
                                                {{ __('Modify') }}
                                            </span>
                                        </div>

                                        @can('admin.estudiante.edit')
                                            <div class="col-12">
                                                <a  href="{{ route('admin.estudiante.edit', [$estudiante->id]) }}"
                                                    class="text-dark">
                                                    {{ __('Edit Student') }}
                                                </a>
                                            </div>
                                        @endcan

                                        <div class="col-12">

                                            @if ( empty($asignacion_grado) )
                                                @can('admin.estudiante.inscripcion')
                                                    <a  href="{{ route('admin.estudiante.inscripcion', [$estudiante->id]) }}"
                                                        class="text-dark">
                                                        {{ __('Enroll Student') }}
                                                    </a>
                                                @endcan
                                            @else
                                                @can('admin.estudiante.cambiargrado')
                                                    <a  href="{{ route('admin.estudiante.cambiargrado', [$estudiante->id]) }}"
                                                        class="text-dark">
                                                        {{ __('Change Grade') }}
                                                    </a>
                                                @endcan
                                            @endif

                                        </div>

                                        @can('admin.foto')
                                            <div class="col-12">
                                                <a  href="{{ route('admin.foto.index', [$estudiante->user->id]) }}"
                                                    class="text-dark">
                                                    {{ __('Change Photo') }}
                                                </a>
                                            </div>
                                        @endcan
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="accordion">

                        <!-- Card Additional Information -->
                        <div class="card shadow-none">
                            <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                                <div class="card-header pb-0">
                                    <h5 class="card-title text-dark font-weight-bold">
                                        {{ __('Additional Information') }}
                                    </h5>
                                </div>
                            </a>
                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="row">

                                        <!-- Card Student's Information -->
                                        <div class="col-md-12 mb-3">
                                            <div class="card shadow-none h-100">
                                                <div class="card-header bg-transparent pb-0">
                                                    <h2 class="card-title">
                                                        <i class="fas fa-child mr-2"></i>
                                                        {{ __("Student's Information") }}
                                                    </h2>
                                                </div>

                                                <div class="card-body pb-0">
                                                    <dl class="row mb-0">
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <dt class="col-sm-6">
                                                                    {{ __('Birthday') }}
                                                                </dt>
                                                                <dd class="col-sm-6">
                                                                    {{ date("d-m-Y", strtotime($estudiante->fecha_nacimiento)) }}
                                                                </dd>

                                                                <dt class="col-sm-6">
                                                                    {{ __('Gender') }}
                                                                </dt>
                                                                <dd class="col-sm-6">
                                                                    @if ( empty($estudiante->genero) ) {!! $empty_text !!} @else {{ $estudiante->genero }} @endif
                                                                </dd>

                                                                <dt class="col-sm-6">
                                                                    {{ __('Laterality') }}
                                                                </dt>
                                                                <dd class="col-sm-6">
                                                                    @if ( empty($estudiante->lateralidad) ) {!! $empty_text !!} @else {{ $estudiante->lateralidad }} @endif
                                                                </dd>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <dt class="col-sm-6">
                                                                    {{ __('Address') }}
                                                                </dt>
                                                                <dd class="col-sm-6">
                                                                    @if ( empty($estudiante->direccion) ) {!! $empty_text !!} @else {{ $estudiante->direccion }} @endif
                                                                </dd>

                                                                <dt class="col-sm-6">
                                                                    {{ __('Phone Number') }}
                                                                </dt>
                                                                <dd class="col-sm-6">
                                                                    {{ $estudiante->telefono }}
                                                                </dd>

                                                                <dt class="col-sm-6">
                                                                    {{ __('E-Mail Address') }}
                                                                </dt>
                                                                <dd class="col-sm-6">
                                                                    {{ $estudiante->email }}
                                                                </dd>
                                                            </div>
                                                        </div>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Card Mother's Information -->
                                        @foreach ($estudiante->tutor as $tutor)
                                            <div class="col-md-4 mb-3 mb-md-0">
                                                <div class="card shadow-none h-100">
                                                    <div class="card-header bg-transparent pb-0">
                                                        <h2 class="card-title">
                                                            @if ( $tutor->tutor == 'padre' )
                                                                <i class="fas fa-male mr-2"></i>
                                                                {{ __("Father's Information") }}
                                                            @elseif ( $tutor->tutor == 'madre' )
                                                                <i class="fas fa-female mr-2"></i>
                                                                {{ __("Mother's Information") }}
                                                            @else
                                                                <i class="fas fa-male mr-2"></i>
                                                                {{ __("Tutor's Information") }}
                                                            @endif

                                                        </h2>
                                                    </div>

                                                    <div class="card-body pb-0">
                                                        <dl class="row mb-0">
                                                            <dt class="col-sm-6">
                                                                {{ __('Name') }}
                                                            </dt>
                                                            <dd class="col-sm-6">
                                                                @if ( empty($tutor->nombre) ) {!! $empty_text !!} @else {{ $tutor->nombre }} @endif
                                                            </dd>

                                                            <dt class="col-sm-6">
                                                                {{ __('DPI') }}
                                                            </dt>
                                                            <dd class="col-sm-6">
                                                                @if ( empty($tutor->dpi) ) {!! $empty_text !!} @else {{ $tutor->dpi }} @endif
                                                            </dd>

                                                            <dt class="col-sm-6">
                                                                {{ __('Address') }}
                                                            </dt>
                                                            <dd class="col-sm-6">
                                                                @if ( empty($tutor->direccion) ) {!! $empty_text !!} @else {{ $tutor->direccion }} @endif
                                                            </dd>

                                                            <dt class="col-sm-6">
                                                                {{ __('Phone Number') }}
                                                            </dt>
                                                            <dd class="col-sm-6">
                                                                @if ( empty($tutor->telefono) ) {!! $empty_text !!} @else {{ $tutor->telefono }} @endif
                                                            </dd>

                                                            <dt class="col-sm-6">
                                                                {{ __('E-Mail Address') }}
                                                            </dt>
                                                            <dd class="col-sm-6">
                                                                @if ( empty($tutor->email) ) {!! $empty_text !!} @else {{ $tutor->email }} @endif
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

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

    <script src="{{ asset('scripts/colaboradores-datatable.js') }}"></script>

    @include('extensions.toast-process-result')

@endsection

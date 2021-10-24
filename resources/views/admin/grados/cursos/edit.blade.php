@extends('layouts.app')

@section('head')

    <title>{{ __('Edit Course') }} - {{ config('app.name', 'Sistema') }}</title>

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
                            <i class="fas fa-book mr-1"></i>
                            {{ __('Edit Course') }}
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.grado.index') }}">
                                    {{ __('Grade')}}
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.grado.show', [$grado->id]) }}">
                                    {{ $grado->nombre }}
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.curso.show', [$grado->id, $curso->id]) }}">
                                    {{ $curso->nombre }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ __('Edit Course') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <form action="{{ route('admin.curso.update', [$grado->id, $curso->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <!-- Card Institutional Information -->
                        <div class="col-12">
                            <div class="card shadow-none">

                                <div class="card-header pb-1">
                                    <h5 class="font-weight-bold">
                                        {{ __('Course Description') }}
                                    </h5>
                                </div>

                                <div class="card-body">
                                    <div class="row p-md-3">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nombre">
                                                    {{ __('Name of Course') }}
                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control form-control-border @error('nombre') is-invalid @enderror"
                                                    id="nombre"
                                                    name="nombre"
                                                    placeholder="{{ trans('forms-grade.name_course') }}"

                                                    autocomplete="off"
                                                    value="{{ $curso->nombre }}"
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
                                                <label for="periodos">
                                                    {{ __('Periods of Course') }}
                                                </label>

                                                <input
                                                    type="number"
                                                    class="form-control form-control-border"
                                                    id="periodos"
                                                    name="periodos"
                                                    placeholder="{{ trans('forms-grade.periods_course') }}"
                                                    autocomplete="off"
                                                    value="{{ $curso->periodos }}"
                                                >
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="curricular">
                                                    {{ __('State of Course') }}
                                                </label>

                                                <select
                                                    name="curricular"
                                                    id="curricular"
                                                    class="form-control form-control-border"
                                                    autocomplete="off"
                                                    value="{{ old('curricular') }}"
                                                >
                                                    <option value="{{ $curso->curricular }}">{{ $curso->curricular == true ? __('Curricular') : __('Not Curricular') }}</option>
                                                    @if ($curso->curricular == true)
                                                        <option value="0">{{ __('Not Curricular') }}</option>
                                                    @else
                                                        <option value="1">{{ __('Curricular') }}</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nombre_grado">
                                                    {{ __('Degre') }}
                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control form-control-border"
                                                    id="nombre_grado"
                                                    name="nombre_grado"
                                                    placeholder="{{ trans('forms-grade.name_course') }}"
                                                    readonly
                                                    autocomplete="off"
                                                    value="{{ $grado->nombre }} - {{ $grado->seccion }}"
                                                >

                                                <input
                                                    type="hidden"
                                                    name="grado"
                                                    id="grado"
                                                    value="{{ $grado->id }}"
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
                                href="{{ route('admin.curso.show', [$grado->id, $curso->id]) }}"
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

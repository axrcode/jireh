@extends('layouts.app')

@section('head')

    <title>{{ __('Create Grade') }} - {{ config('app.name', 'Sistema') }}</title>

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
                            <i class="fas fa-th-list mr-1"></i>
                            {{ __('Create Grade') }}
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.grado.index') }}">
                                    {{ __('Grade')}}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ __('Create Grade') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <form action="{{ route('admin.grado.store') }}" method="POST">
                    @csrf

                    <div class="row">

                        <!-- Card Institutional Information -->
                        <div class="col-12">
                            <div class="card shadow-none">

                                <div class="card-header pb-1">
                                    <h5 class="font-weight-bold">
                                        {{ __('Grade Description') }}
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
                                                    placeholder="{{ trans('forms-grade.name') }}"
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

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="seccion">
                                                    {{ __('Section') }}
                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control form-control-border"
                                                    id="seccion"
                                                    name="seccion"
                                                    placeholder="{{ trans('forms-grade.section') }}"
                                                    data-inputmask='"mask": "#"' data-mask
                                                    autocomplete="off"
                                                    value="{{ old('seccion') }}"
                                                >
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="usuario">
                                                    {{ __('Level') }}
                                                </label>

                                                <select
                                                    name="nivel"
                                                    id="nivel"
                                                    class="form-control form-control-border @error('nivel') is-invalid @enderror"
                                                    required
                                                    autocomplete="off"
                                                    value="{{ old('usuario') }}"
                                                >
                                                    <option value="">{{ trans('forms-grade.select_level') }}</option>
                                                    <option value="Preprimaria">{{ __('Kinder') }}</option>
                                                    <option value="Primaria">{{ __('Primary') }}</option>
                                                    <option value="Básico">{{ __('Middle School') }}</option>
                                                    <option value="Diversificado">{{ __('High School') }}</option>
                                                </select>

                                                @error('nivel')
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

                        <!-- Buttons -->
                        <div class="offset-md-6 col-md-3 mb-3">
                            <a
                                href="{{ route('admin.grado.index') }}"
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
                                {{ __('Save Grade') }}
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

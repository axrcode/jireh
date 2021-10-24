@extends('layouts.app')

@section('head')

    <title>{{ __('Delete Course') }} - {{ config('app.name', 'Sistema') }}</title>

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
                    <div class="col-sm-4">
                        <h1 class="font-weight-bold m-0">
                            <i class="fas fa-th-list mr-1"></i>
                            {{ __('Delete Course') }}
                        </h1>
                    </div>
                    <div class="col-sm-8">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.grado.index') }}">
                                    {{ __('Grade') }}
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
                                {{ __('Delete Course') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <form action="{{ route('admin.curso.destroy', [$grado->id, $curso->id]) }}" method="POST" novalidate>
                    @csrf
                    @method('DELETE')

                    <div class="row">

                        <!-- Card Institutional Information -->
                        <div class="col-12">
                            <div class="card shadow-none">

                                <div class="card-body">
                                    <div class="row p-md-3">

                                        <div class="col-12">
                                            <h3>¿ {{ __('Are you sure you want to eliminate the course') }}
                                                <span class="font-weight-bold">{{ $curso->nombre }}</span>
                                                ?
                                            </h3>

                                            <p class="text-muted my-4">
                                                {{ __("To confirm that you want to delete the course, write the word 'DELETE' in the text box and activate the checkbox") }}
                                            </p>
                                        </div>

                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="eliminar">
                                                            {{ __('Check') }}
                                                        </label>

                                                        <input
                                                            type="text"
                                                            class="form-control form-control-border @error('eliminar') is-invalid @enderror"
                                                            id="eliminar"
                                                            name="eliminar"
                                                            value="{{ old('eliminar') }}"
                                                            placeholder="{{ trans('forms-grade.delete_grade') }}"
                                                            required
                                                            autocomplete="off"
                                                        >

                                                        @error('eliminar')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input @error('check') is-invalid @enderror"
                                                        type="checkbox"
                                                        name="check"
                                                        required
                                                    >

                                                    <label class="form-check-label">
                                                        {{ __('Confirm to Delete') }}
                                                    </label>

                                                    @error('check')
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
                        </div>

                        <!-- Buttons -->
                        <div class="offset-md-6 col-md-3 mb-3">
                            <a
                                href="{{ route('admin.grado.show', [$grado->id]) }}"
                                class="btn btn-secondary btn-block btn-flat">
                                <i class="fas fa-window-close mr-2"></i>
                                {{ __('Cancel') }}
                            </a>
                        </div>

                        <div class="col-md-3 mb-3">
                            <button
                                type="submit"
                                class="btn btn-success btn-block btn-flat">
                                <i class="fas fa-trash mr-2"></i>
                                {{ __('Delete Grade') }}
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

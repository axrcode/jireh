@extends('layouts.app')

@section('head')

    <title>{{ __('Change Photo') }} - {{ config('app.name', 'Sistema') }}</title>

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
                            <i class="fas fa-camera mr-1"></i>
                            {{ __('Change User Photo') }}
                        </h1>
                    </div>
                    <div class="col-sm-8">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ $is_colaborador == true ? route('admin.colaborador.index') : route('admin.estudiante.index') }}">
                                    @if ($is_colaborador == true) {{ __('Collaborators') }} @else {{ __('Students')}} @endif
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ $usuario->user->name }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <form action="{{ route('admin.foto.update', [$usuario->user->id]) }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-12">
                            <div class="card shadow-none">

                                <div class="card-body">
                                    <div class="row p-md-3">

                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="actual">
                                                        {{ __('Current Photo') }}
                                                    </label>

                                                    <figure>
                                                        <img
                                                            src="{{ $usuario->fotografia }}"
                                                            class="img-thumbnail w-100"
                                                            alt="Foto del usuario"
                                                            onerror="this.src='/img/profile-default.jpg'"
                                                        >
                                                    </figure>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="foto">
                                                            {{ __('Upload New Photo') }}
                                                        </label>

                                                        <input
                                                            type="file"
                                                            class="upload-box shadow-sm w-100 @error('foto') is-invalid @enderror"
                                                            id="foto"
                                                            name="foto"
                                                            accept="image/*"
                                                            required
                                                        >

                                                        @error('foto')
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
                        </div>

                        <!-- Buttons -->
                        <div class="offset-md-6 col-md-3 mb-3">
                            <a
                                href="{{ $is_colaborador == true ? route('admin.colaborador.show', [$usuario->id]) : route('admin.estudiante.show', [$usuario->id]) }}"
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

    @include('extensions.toast-process-result')

@endsection

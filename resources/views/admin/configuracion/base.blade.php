@extends('layouts.app')

@section('head')

    <title>{{ __('General Parameters') }} - {{ config('app.name', 'Sistema') }}</title>

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
                    <div class="col-12">
                        <h1 class="font-weight-bold m-0">
                            <i class="fas fa-sliders-h mr-1"></i>
                            {{ __('General Parameters') }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">

                    <div class="col-12 col-md-4">
                        <div class="card shadow-none">
                            <div class="card-header pb-0 bg-white">
                                <p class="card-title font-weight-bold">{{ __('Configurations') }}</p>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="col-12">
                                    <a href="" class="text-dark">
                                        {{ __('General Parameters') }}
                                    </a>
                                </div>

                                <hr class="my-2">

                                <div class="col-12">
                                    <a href="" class="text-dark">
                                        {{ __('Setup Social Networks') }}
                                    </a>
                                </div>

                                <hr class="my-2">

                                <div class="col-12">
                                    <a href="" class="text-dark">
                                        {{ __('Course Notation') }}
                                    </a>
                                </div>

                                <hr class="my-2">

                                <div class="col-12">
                                    <a href="" class="text-dark">
                                        {{ __('Configure Units') }}
                                    </a>
                                </div>

                                <hr class="my-2">

                                <div class="col-12">
                                    <a href="" class="text-dark">
                                        {{ __('Setup Consolidated and Ballots') }}
                                    </a>
                                </div>

                                <hr class="my-2">

                                <div class="col-12">
                                    <a href="" class="text-dark">
                                        {{ __('Set Attitudinal') }}
                                    </a>
                                </div>

                                <hr class="my-2">

                                <div class="col-12">
                                    <a href="" class="text-dark">
                                        {{ __('Manage Directors') }}
                                    </a>
                                </div>

                                <hr class="my-2">

                                <div class="col-12">
                                    <a href="" class="text-dark">
                                        {{ __('Manage Secretaries') }}
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-8">

                        @yield('configuraciones')

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

    @include('extensions.toast-process-result')

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

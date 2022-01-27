<nav class="main-header navbar navbar-expand navbar-light">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <div class="col-12 pt-1">
                    <button type="submit"
                        class="btn btn-outline-danger btn-sm btn-flat btn-block">
                        <i class="fas fa-sign-out-alt"></i>
                        {{ __('Logout') }}
                    </button>
                </div>
            </form>
        </li>
    </ul>
</nav>

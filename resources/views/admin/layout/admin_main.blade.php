<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Start Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Title of Site -->
    <title>{{config('app.name')}}</title>
    
    <!-- Favicons -->
    <link rel="icon" type="image/png" href="">
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/website/images/favicon.png')}}">

    @include('admin.layout.header')

</head>

<body class="{{request()->is('add-bill') ? 'toggle-sidebar' : '' }} {{request()->is('edit-bill/*') ? 'toggle-sidebar' : '' }} ">
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between m-2">
            <a href="" class="logo d-flex align-items-center">
                <span class="d-none d-lg-block">{{env('APP_NAME')}}</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="{{asset('assets/admin/img/user.png')}}" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{auth()->guard('admin')->user()->name}}</span>
                    </a>
                    <!-- End Profile Image Icon -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.logout') }}">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->
            </ul>
        </nav>
    </header>
    <!-- End Header -->
    <!-- ======= Sidebar ======= -->
    @include('admin.layout.sidebar')
    <!-- End Sidebar-->
    <!-- Main -->
    <main role="main" id="main" class="main">
        @include('admin.layout.message')
        @yield('content')
    </main>
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
    </footer><!-- End Footer -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
    <script src="{{asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/admin/vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Template Main JS File -->
    <script src="{{asset('assets/admin/js/main.js')}}"></script>
    <!-- Pages Script -->
    <script>
        Notiflix.Notify.Init({});
        Notiflix.Confirm.Init({});
        Notiflix.Loading.Init({});

        $(document).ready(function() {
           
        });
    </script>
    @yield('script')
</body>

</html>
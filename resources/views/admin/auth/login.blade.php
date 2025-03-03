<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Start Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Mobile Suraksha">
    <meta name="keywords" content="">
    <meta name="author" content="Monjur Akhter">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Title of Site -->
    <title>{{config('app.name')}}</title>

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="">
    <link rel="icon" type="image/png" href="assets/img/favicon-2.png">
    <!-- Jquery JS -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <!-- Vendor CSS Files -->
    <link href="{{asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet">
    <!-- Vendor JS Files -->
    <script src="{{asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var toastEl = document.getElementById("showToast");
            if (toastEl) {
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            }
        });
    </script>

<body class="d-flex align-items-center py-4 bg-body-tertiary" style="height: 100vh;">
    <main class="form-signin m-auto">
        @include('admin.layout.message')
        <div class="card">
            <div class="card-body mt-4">
                <form class="text-center" action="{{ route('admin.store') }}" method="post">
                    @csrf
                    @method('POST')
                    <img class="mb-3" src="{{asset('assets/website/images/logo.png')}}" alt="" height="80">
                    <h5 class="mb-3 fw-normal">Administrator sign in</h5>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" required autofocus>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                        <label for="floatingInput">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" required name="password">
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                        <label for="floatingPassword">Password</label>
                    </div>
                    <button class="btn btn-primary w-100 rounded-pill" type="submit">SIGN IN</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
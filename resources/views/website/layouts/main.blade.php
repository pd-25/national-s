<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title> @stack('title') | {{env('APP_NAME')}}</title>
<meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="">

@include('website.layouts.headerscript')
</head>
<body>
    @include('website.layouts.header')
    @yield('web-content')
    @include('website.layouts.footer')
    @stack('web-script')
</body>
</html>
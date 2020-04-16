<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('public/images/icons/favicon.ico') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/main.css') }}">
    google-site-verification: googledd69b76265653cde.html
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
            @yield("main")
        </div>
    </div>
</div>
<script src="{{ asset('public/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('public/bootstrap/js/popper.js') }}"></script>
<script src="{{ asset('public/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/select2/select2.min.js') }}"></script>
<script src="{{ asset('public/js/main.js') }}"></script>

</body>
</html>
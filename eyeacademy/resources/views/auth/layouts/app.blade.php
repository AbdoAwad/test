<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="{{ asset('dashboard/front/images/fav.png') }}" type=image/png/>
    <link rel="shortcut icon" type="image/x-icon" href=" {{ asset('icon/favicon.png') }}" />
    <title>Eye Academy </title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap Core and vandor -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">

    <!-- Core css -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/main.css') }}"/>
    <link rel="stylesheet" href="{{ asset('dashboard/css/theme1.css') }}"/>
    @stack('css')
</head>
<body class="font-montserrat sidebar_dark">
@yield('content')
@stack('modal')
<script src="{{ asset('dashboard/bundles/lib.vendor.bundle.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="{{ asset('dashboard/plugins/animated-modal/animatedModal.min.js') }}"></script>
<script src="{{ asset('dashboard/bundles/lib.vendor.bundle.js')}}"></script>
<script src="{{ asset('dashboard/js/core.js')}}"></script>
<script src="{{ asset('js/aos.js') }}"></script>
@stack('js')
</body>
</html>

<!doctype html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<link rel="icon" href="{{ asset('dashboard/front/images/fav.png') }}" type=image/png/>

<link rel="shortcut icon" type="image/x-icon" href=" {{ asset('icon/favicon.png') }}" />
<title>Eye Academy</title>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Bootstrap Core and vandor -->
<link rel="stylesheet" href="{{ asset('dashboard/plugins/bootstrap/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('dashboard/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" />
<link rel="stylesheet" href="{{ asset('dashboard/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">
<link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.min.css') }}">
<!-- Core css -->
<link rel="stylesheet" href="{{ asset('dashboard/css/main.css') }}"/>
<link rel="stylesheet" href="{{ asset('dashboard/css/theme1.css') }}"/>
<link href="{{ asset('dashboard/css/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/aos.css ') }}">
@stack('css')
</head>

<body class="font-montserrat sidebar_dark">
	<!-- Page Loader -->
{{--	<div class="page-loader-wrapper">--}}
{{--		<div class="loader">--}}
{{--		</div>--}}
{{--	</div>--}}

    <section class="loading-overlay">
        <div class="lds-ripple"><div></div><div></div></div>
    </section>

	<div id="main_content">
		@include('layouts.sidebar')

		<div class="page">
			@include('layouts.header', ['header_title' => $header_title ?? ''])

			<div class="section-body mt-3">
					@include('layouts.ms')
				@yield('content')
			</div>
		</div>
	</div>

	<div id="div-modal"></div>
	@stack('modal')
	<script src="{{ asset('js/sweetalert.min.js') }}"></script>
	<script src="{{ asset('js/alert.js') }}"></script>


    <script src="{{ asset('dashboard/bundles/lib.vendor.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/bundles/counterup.bundle.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

	<script src="{{ asset('dashboard/plugins/animated-modal/animatedModal.min.js') }}"></script>
	<script src="{{ asset('dashboard/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
	<script src="{{ asset('dashboard/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>

	<script src="{{ asset('dashboard/js/core.js')}}"></script>


    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        AOS.init();
    </script>

    <script>
        $(window).on('load', function(){
            $(".loading-overlay").fadeOut(500);
            $("body").css("overflow","auto");
            $("body").css("overflow-x","hidden");
        });


    </script>


	@stack('js')

</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>StockPilot </title>
    <link rel="stylesheet" href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css') }}" />
    {{-- dashboard --}}
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/dashboard/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/dashboard/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/dashboard/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="/dashboard/css/style.css" rel="stylesheet">

    {{-- for home --}}

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('home/css/bootstrap.min.css') }}" type="text/css">

    <!-- MFP Css -->
    <link rel="stylesheet" href="{{ asset('home/css/magnific-popup.css') }}">

    <!-- Material Icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/materialdesignicons.min.css') }}" />

    <!-- Pe7 Icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/pe-icon-7.css') }}">

    <!-- Owl Slider -->
    <link rel="stylesheet" href="{{ asset('home/css/owl.carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('home/css/owl.theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('home/css/owl.transitions.css') }}" />

    <!-- Custom  Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/style.css') }}" />



    @vite('resources/js/app.js')
    @inertiaHead

</head>


<body>

        @inertia



    <script src="https://cdn.jsdelivr.net/npm/simple-notify/dist/simple-notify.min.js"></script>
    <script src="https://kit.fontawesome.com/80f99d64b1.js" crossorigin="anonymous"></script>


    {{-- for home --}}

    <!-- Javascript -->
    <script src="{{ asset('home/js/jquery.min.js') }}"></script>


    <!-- Owl Js -->
    <script src="{{ asset('home/js/owl.carousel.min.js') }}"></script>
    <!-- Parallax Js -->
    <script src="{{ asset('home/js/parallax.js') }}"></script>
    {{-- <!-- Particles Js hero animation-->
    <script src="{{ asset('home/js/particles.js') }}"></script>
    <script src="{{ asset('home/js/particles.app.js') }}"></script> --}}

    <!-- MFP JS for carousel ***** -->
    <script src="{{ asset('home/js/jquery.magnific-popup.min.js') }}"></script>

    <!-- Custom Js   for menu color and carousel-->
    <script src="{{ asset('home/js/custom.js') }}"></script>


</body >

</html>

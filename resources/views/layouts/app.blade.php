<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" id="csrf_token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{asset('fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/ruang-admin.css')}}" rel="stylesheet">

    <link href="{{asset('css/datatablecss/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/datatablecss/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/datatablecss/toastr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet" type="text/css" />

    <style>
        table td {
            text-align: justify;
            font-size: 0.7rem;
            line-height: 1rem;
            text-transform: uppercase;
        }

        table th {
            text-align: center;
            font-size: 0.7rem;
            text-transform: uppercase;
        }

        select {
            width: 100px;

        }

        option {
            width: 150px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        @auth
        @include('layouts.sidebar')
        @endauth
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @auth
                @include('layouts.nav')
                @endauth
                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    @yield('content')
                </div>
                <!---Container Fluid-->
            </div>
            <!-- Footer -->
            @auth
            @include('layouts.footer')
            @endauth
            <!-- Footer -->
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="text-primary fas fa-angle-up"></i>
    </a>

    <script src="{{asset('js/datatablejs/jquery-3.3.1.js')}}"></script>
    <script src="{{asset('js/datatablejs/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/datatablejs/popper.min.js')}}"></script>
    <script src="{{asset('jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('js/ruang-admin.min.js')}}"></script>

    <script src="{{asset('js/datatablejs/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/datatablejs/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('js/datatablejs/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/datatablejs/toastr.min.js')}}"></script>

    <script src="{{ asset('/js/puntitos.js') }}"></script>
    <script src="{{ asset('/js/select2.min.js') }}"></script>

    <script>
        $('.select-modalVehiculoRegister-propietario').select2({
            dropdownParent: $("#modalVehiculoRegister"),
            theme: "classic",
            width: 'resolve',
        });
    </script>

    @yield('scripts')

</body>

</html>
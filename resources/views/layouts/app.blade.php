<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{asset('img/icon.png')}}" rel="icon">

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
    <link href="{{asset('css/colors.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/panels.css')}}" rel="stylesheet" type="text/css" />

</head>

<body id="page-top">
    <style>
        body {
            font-size: 0.9rem;
        }

        .btn-circle.btn-xl {
            width: 70px;
            height: 70px;
            padding: 10px 16px;
            border-radius: 35px;
            font-size: 24px;
            line-height: 1.33;
        }

        .btn-circle {
            width: 30px;
            height: 30px;
            padding: 6px 0px;
            border-radius: 15px;
            text-align: center;
            font-size: 12px;
            line-height: 1.42857;
        }

        table td {
            text-align: justify;
            font-size: 0.8rem;
            line-height: 1rem;
        }


        table th {
            text-align: center;
            font-size: 0.8rem;
        }

        input {
            font-family: inherit;
            font-style: italic;
            font-weight: bold;
            background: rgba(0, 0, 0, 0.02);
            color: #000 !important;
            transition: all 0.15s ease;
        }
        }
    </style>
    <div id="wrapper">
        @auth
        @include('layouts.sidebar')
        @endauth
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @auth
                @include('layouts.nav')
                @endauth

                <div class="container-fluid" id="container-wrapper">
                    <div class="text">
                        @yield('content')
                    </div>
                </div>
            </div>
            @auth
            @include('layouts.footer')
            @endauth
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
    <script src="{{asset('js/axios.min.js')}}"></script>
    <script src="{{asset('js/autoComplete.min.js')}}"></script>


    <script src="https://rawcdn.githack.com/AmagiTech/amagibootstrapsearchmodalforselect/9c7fdf8903b3529ba54b2db46d8f15989abd1bd1/amagidropdown.js">
    </script>

    <script>
        var SITEURL = document.location.origin;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>


    <script>
        const DEBUG = false;
        // ENABLE/DISABLE Console Logs
        if (!DEBUG) {
            // console.log = function() {}
            // console.error = function() {}
        }


        toastr.options = {
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
        }

        const btnSearh = document.querySelector('.btnSearh')
        btnSearh.addEventListener('click', () => {

            toastr.options = {
                positionClass: "toast-bottom-right",
                preventDuplicates: true,
            }
            toastr.info('Estamos buscando...')
        })
    </script>
    <script src="{{asset('js/select2.min.js')}}"></script>

    <script>
        $('.selectpickers').select2({
            dropdownParent: $("#formServiceRegister"),

        });

        $('.selectpickerscliente').select2({
            dropdownParent: $("#formServiceRegister"),

        });

        $('.selectpickersequipo').select2({
            dropdownParent: $("#formServiceRegister"),

        });

        $('.selectpickeres').select2({
            dropdownParent: $("#formRegisterEquipoServicio"),
        });


        $('.selectpickersclienteES').select2({
            dropdownParent: $("#formRegisterEquipoServicio"),
        });
    </script>
    @stack('scripts')

    <!--     @auth-->
    <!--        <a href = "#" onClick="window.location = 'https://wa.me/573187758303?text=Me%20gustaría%20saber%20sobre%20mi%20servicio%20'"><img class="img-fluid" src="{{asset('whats.png')}}" alt="mantenimeinto_barrancabermeja" style='position:fixed; z-index:1; bottom:0; left:8%; margin-bottom: 2%;' title="Contactar" name="Contactar">-->
    <!--        </a>-->
    <!--    @endauth-->
</body>

</html>
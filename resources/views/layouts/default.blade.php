<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>
        @section('title')@show
    </title>

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('fonts/iconmind.css') }}">
    
    <!-- global css -->
    <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('vendors/perfect-scrollbar/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

    <style>
        #demo {
            position: relative;

            overflow: auto;
        }

    </style>
    <!-- end of global css -->

    <!-- vendors  css -->
    @yield('header_styles')
</head>

<body>
    <!-- header logo: style can be found in header-->
    <header class="header" id="hasHeaderTopo">
        <nav class="navbar navbar-expand-lg navbar-light navbar-static-top" role="navigation">
            
            <a href="javascript:void(0)" class="ml-100 toggle-right d-xl-none d-lg-block">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img src="{{ asset('img/images/toggle.png') }}" alt="logo" />
            </a>
            <!-- Header Navbar: style can be found in header-->
            <!-- Sidebar toggle button-->
            <!-- Sidebar toggle button-->
            <div class="navbar-right ml-auto">
                <ul class="navbar-nav nav">
                    <li class="nav-item notifications-menu text-center mt-3  text-center"> 
                        {{-- <span id="demo"></span>--}}
                         <span id="dia-data-hora"></span>
                     </li>
                    <li class="dropdown notifications-menu nav-item dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle nav-link dropdown-toggle"
                            data-toggle="dropdown" id="navbarDropdown">
                            <i class="im im-icon-Boy fs-16"></i>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-notifications table-striped" aria-labelledby="navbarDropdown">

                            <li class="dropdown-footer">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    {{ __('Sair') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="wrapper"">

        <!-- Left side column. contains the logo and sidebar -->
        <aside class="left-aside">
            <!-- sidebar: style can be found in sidebar-->
            <section class="sidebar metismenu sidebar-res">
                @include("layouts/leftmenu")
                <!-- menu -->
            </section>
            <!-- /.sidebar -->
        </aside>

        <!--            right side bar ----------->
        <aside class="right-aside">
            @yield('content')
        </aside>
    </div>
    <!-- ./wrapper -->
    <!-- Footer end -->
    <!-- SCRIPTS -->
    <!-- global js -->
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <!-- end of page level js -->
    <!-- Start of vendor js -->
    @yield('footer_scripts')

    <script src="{{ asset('vendors/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    {{--<script src="http://utatti.github.io/perfect-scrollbar/prettify.js"></script>
    --}}
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js" ></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" ></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        // Função para formatar 1 em 01
        const zeroFill = n => {
            return ('0' + n).slice(-2);
        }
        // Cria intervalo
        const interval = setInterval(() => {
            // Pega o horário atual
            const now = new Date();
            
            // Dias da semana 
            var semana = ["Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado"];
    
            // Formata a data conforme dd/mm/aaaa hh:ii:ss
            const dataHora = semana[now.getDay()] + ' ' + (now.getUTCDate()) + '/' + zeroFill((now.getMonth() + 1)) + '/' + now.getFullYear() + ' ' + zeroFill(now.getHours()) + ':' + zeroFill(now.getMinutes()) + ':' + zeroFill(now.getSeconds());
            // Exibe na tela usando a div#data-hora
            document.getElementById('dia-data-hora').innerHTML = dataHora;}, 1000);

            $("#rolavel").bind("mousewheel",function(ev, delta) {
                var scrollTop = $(this).scrollTop();
                $(this).scrollTop(scrollTop-Math.round(delta));
            });
    </script>
    @stack('scripts')
</body>

</html>

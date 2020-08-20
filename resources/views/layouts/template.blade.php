<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Estoque</title>
    <meta name="description" content="Free Bootstrap 4 Admin Theme | Pike Admin">
    <meta name="author" content="Pike Web Development - https://www.pikephp.com">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    
    
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}">
    <link href="{{ asset('css/estilo.css') }}" rel="stylesheet"> 
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Font Awesome CSS -->
    <link href="{{ asset('assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />

    <!-- BEGIN CSS for this page -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" />
    <!-- END CSS for this page -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   
</head>

<body class="adminbody">

    <div id="main">

        <!-- top bar navigation -->
        <div class="headerbar">

            <!-- LOGO -->
            <div class="headerbar-left ">
                <a href="{{route('home')}}" class="logo"><img alt="Logo" src="{{ asset('assets/images/logo.png')}}" /> <span>EDUS</span></a>   
            </div>
            <nav class="navbar-custom">
                <ul class="list-inline float-right mb-0">      
                    <li class="list-inline-item  text-center text-white"> 
                       {{-- <span id="demo"></span>--}}
                        <span id="dia-data-hora"></span>
                    </li>
                    <li class="list-inline-item dropdown notif">
                        <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <img src="{{ asset('assets/images/avatars/foto1.png')}}" alt="Profile image" class="avatar-rounded">

                            <span>{{Auth::user()->nome}}</span>

                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <span>{{Auth::user()->nome}}</span>
                            </div>

                            <!-- item-->
                            <a href="pro-profile.html" class="dropdown-item notify-item">
                                <i class="fa fa-user"></i> <span>Perfil</span>
                            </a>

                            <!-- item-->
                            <a href="#" class="dropdown-item notify-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                <i class="metismenu-icon fas fa-power-off"></i>{{ __('Sair') }}
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </a> 

                            <!-- item-->
                            <a target="_blank" href="#" class="dropdown-item notify-item">
                                <i class="metismenu-icon fas fa-store-alt"></i><span>Mudar de Loja</span>
                            </a>
                        </div>
                    </li>

                </ul>

                <ul class="list-inline menu-left mb-0">
                    <li class="float-left">
                        <button class="button-menu-mobile open-left">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                    </li>
                </ul>

            </nav>

        </div>
        <!-- End Navigation -->
      

        <!-- Left Sidebar -->
        <div class="" id="">
            <div class="left main-sidebar" id="leftbar">
                <div class="sidebar-inner leftscroll headerbar-menu-left">
                    <div id="sidebar-menu">
                        <ul>
                            <li class="submenu">
                                <a class="active" href="{{route('home')}}"><i class="fa fa-fw fa-home"></i><span> Início </span>
                                </a>
                            </li>
                            {{-- <li class="submenu">
                                <a href="#"><i class="fa fa-fw fa-area-chart"></i><span> Clientes </span> </a>
                            </li> --}}
                            <li class="submenu">
                                <a href="#"><i class="fas fa-fw fa-boxes"></i> <span> Estoque </span> <span
                                        class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                <li><a href="{{route('produto.index')}}">Cadastrar Produto</a></li>
                                    <li><a href="#">Consultar Estoque</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="#"><i class="fas fa-file"></i> <span> Pedidos </span> <span
                                        class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="#">Criar Pedidos</a></li>
                                    <li><a href="#">Consultar Pedidos</a></li>
                                    <li><a href="#">Ordem de Produção</a></li>
                                </ul>
                            </li>

                            <li class="submenu">
                                <a href="#"><i class="fa fa-fw fa-barcode"></i> <span> Cadastro </span> <span
                                        class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                <li><a href="{{route('produto.index')}}">Produto</a></li>
                                    <li><a href="{{route('cliente.index')}}">Cliente</a></li>
                                    <li><a href="{{route('fornecedor.index')}}">Fornecedor</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="#"><i class="fas fa-chart-bar"></i> <span> Movimentação  </span> <span
                                        class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="star-rating.html">Compras</a></li>
                                    <li><a href="#">Entrada de Produto</a></li>
                                    <li><a href="#">Saída de Produto</a></li>
                                    <li><a href="calendar.html">Historicos</a></li>
                                </ul>
                            </li>

                            <li class="submenu">
                                <a href="#"><i class="fas fa-dollar-sign"></i> <span> Financeiro </span> <span
                                        class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="#">Contas a Pagar</a></li>
                                    <li><a href="#">Contas a Receber</a></li>
                                    <li><a href="#">Faturamento</a></li>
                                    <li><a href="#">Pedidos Pendentes</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="#"><i class="fa fa-fw fa-cogs"></i> <span> Configurações </span> <span
                                        class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="#">Cadastrado de fornecedor</a></li>
                                    <li><a href="#">Perfil e Permissões</a></li>
                                    <li><a href="#">Dados da Empresa</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->


        <div class="content-page">

            <!-- Start content -->
            <div class="content">

                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- END container-fluid -->
            </div>
            <!-- END content -->

        </div>
        <!-- END content-page -->

        <footer class="footer">
            <span class="text-right">
             <a> MVL Sistemas</a>
               {{-- Copyright <a target="_blank" href="#">Your Website</a>--}}
            </span>
            <span class="float-right">
                 Vestilo Uniformes
                {{--Powered by <a target="_blank" href="https://www.pikeadmin.com"><b>Pike Admin</b></a>--}}
            </span>
        </footer>

    </div>
    <!-- END main -->
    
    <script src="{{ asset('assets/js/jquery.min.js')}}" type="text/javascript"></script> 
    <script src="{{ asset('assets/js/popper.min.js')}}"  type="text/javascript"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js')}}"  type="text/javascript"></script>
    <script src="{{ asset('assets/js/pikeadmin.js')}}"  type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/waypoints/lib/jquery.waypoints.min.js')}}"  type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/counterup/jquery.counterup.min.js')}}"  type="text/javascript"></script>
    {{-- <script  src="{{ asset('js/app.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"  type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"  type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"  type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.com/libraries/jquery.mask"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
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
    </script>
   
   
</body>
@stack('scripts')
</html>

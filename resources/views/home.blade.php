@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">EDUS</h1>
                <div class="text-center">
                    <span id="data-hora"></span>
                    <ol class="breadcrumb float-right mt-0">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Dashboard</li> 
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    {{--<div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Info!</h4>
        <p>Do you want custom development to integrate this theme in your project? Or add new features? Contact us on <a
                target="_blank" href="https://www.pikeadmin.com"><b>Pike Admin Website</b></a></p>
        <p>Or try our PRO version: <b>Save over 50 hours of development with our Pro Framework: Registration / Login /
                Users Management, CMS, Front-End Template (who will load contend added in admin area and saved in MySQL
                database), Contact Messages Management, manage Website Settings and many more, at an incredible
                price!</b></p>
        <p>Read more about all PRO features here: <a target="_blank"
                href="https://www.pikeadmin.com/pike-admin-pro"><b>Pike Admin PRO features</b></a></p>
    </div>
--}}
    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card-box noradius noborder bg-success">
                <i class="fas fa-barcode float-right text-white"></i>
                <h6 class="text-white text-uppercase m-b-20">Produtos Cadastros</h6>
                <h1 class="m-b-20 text-white counter">{{$produto->count()}}</h1>
               {{-- <span class="text-white">15 New Orders</span>--}}
            </div>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card-box noradius noborder bg-primary">
                <i class="far fa-address-card float-right text-white"></i>
                <h6 class="text-white text-uppercase m-b-20">CLientes Cadastrados</h6>
                <h1 class="m-b-20 text-white counter">{{$cliente->count()}}</h1>
                {{-- <span class="text-white">Bounce rate: 25%</span> --}}
            </div>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card-box noradius noborder bg-danger">
                <i class="fa fa-user-o float-right text-white"></i>
                <h6 class="text-white text-uppercase m-b-20">Fornecedores Cadastrados</h6>
                <h1 class="m-b-20 text-white counter">{{$fornecedor->count()}}</h1>
                {{-- <span class="text-white">25 New Users</span> --}}
            </div>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card-box noradius noborder bg-secondary">
                <i class="fa fa-bell-o float-right text-white"></i>
                <h6 class="text-white text-uppercase m-b-20">Alerts</h6>
                <h1 class="m-b-20 text-white counter">58</h1>
                <span class="text-white">5 New Alerts</span>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection
@push('scripts')
<script>
    // Função para formatar 1 em 01
    const zeroFill = n => {
        return ('0' + n).slice(-2);
    }
    // Cria intervalo
    const interval = setInterval(() => {
        // Pega o horário atual
        const now = new Date();

        // Formata a data conforme dd/mm/aaaa hh:ii:ss
        const dataHora = zeroFill(now.getUTCDate()) + '/' + zeroFill((now.getMonth() + 1)) + '/' + now.getFullYear() + ' ' + zeroFill(now.getHours()) + ':' + zeroFill(now.getMinutes()) + ':' + zeroFill(now.getSeconds());
        // Exibe na tela usando a div#data-hora
        document.getElementById('data-hora').innerHTML = dataHora;}, 1000);
</script>
@endpush

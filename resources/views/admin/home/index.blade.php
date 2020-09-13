@extends('layouts.default')
{{-- Page title --}}
@section('title')
Dashboard @parent
@stop
{{-- page level styles --}}
@section('header_styles')
<!-- page vendors -->
<link href="{{ asset('css/pages.css')}}" rel="stylesheet">


<!--end of page vendors -->
@stop
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div aria-label="breadcrumb" class="card-breadcrumb">
        <h1>EDUS</h1>

    </div>
    <div class="separator-breadcrumb border-top"></div>
</section>
<!-- /.content -->
<section class="content">
    <div class="row">
        <div class="col-md-6 col-xl-3 col-12 mb-20">
            <div class="  bg-white dashboard-col pl-15 pb-15 pt-15">
                <i class="im-icon-Add-User im-icon-set float-right bg-primary"></i>
                <h3>Clientes</h3>
                {{$cliente->count()}}
                <p class="mb-0 mt-3 "><span></span> <span class="float-right pr-15"></span></p>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 col-12  mb-20">
            <div class="bg-white dashboard-col pl-15 pb-15 pt-15">
                <i class="im-icon-Bar-Code im-icon-set float-right bg-success"></i>
                <h3>Produtos</h3>
                {{$produto->count()}}
                <p class="mb-0 mt-3 "><span></span> <span class="float-right pr-15"></span></p>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 col-12  mb-20">
            <div class="bg-white dashboard-col pl-15 pb-15 pt-15">
                <i class="im im-icon-Love-User im-icon-set float-right bg-info"></i>
                <h3>Fornecedores</h3>
                {{-- <p>Number of Fans</p> --}}
                {{-- <div class="progress mr-15">
                    <div id="progress-info" class="progress-bar bg-info progress-bar-striped progress-bar-animated"
                        role="progressbar" style="width: 1%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
                <p class="mb-0 mt-3 "><span></span> <span class="float-right pr-15"></span></p> --}}
            </div>
        </div>


        <div class="col-md-6 col-xl-3 col-12  mb-20">
            <div class="bg-white dashboard-col pl-15 pb-15 pt-15">
                <i class="im im-icon-Checked-User im-icon-set float-right bg-danger"></i>
                <h3>Funcionários</h3>
                {{-- <p>Total Actions</p> --}}
                {{-- <div class="progress mr-15">
                    <div id="progress-danger" class="progress-bar bg-danger progress-bar-striped progress-bar-animated"
                        role="progressbar" style="width: 1%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
                <p class="mb-0 mt-3 "><span></span> <span class="float-right pr-15"></span>
                </p> --}}
            </div>
        </div>
    </div>


    
</section>

@stop
@section('footer_scripts')
<!--   page level js ----------->
<script language="javascript" type="text/javascript" src="{{ asset('vendors/chartjs/js/Chart.js') }}"></script>
<script src="{{ asset('js/pages/dashboard.js') }}"></script>

<!-- end of page level js -->
@stop

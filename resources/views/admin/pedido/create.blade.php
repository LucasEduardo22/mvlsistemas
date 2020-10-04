@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Pedidos @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <!-- page vendors -->
    <link href="{{ asset('css/pages.css') }}" rel="stylesheet">
    <!--end of page vendors -->
@stop
@section('content')
    @include('includes.alert')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{route('pedido.create')}}">Pedido</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">  
            
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-12">
                        Dados do cliente
                    </div>
                    <div class="col-sm-12">
                       dados produto(tamanhos, quantidades, preços, total )
                    </div> 
                    <div class="col-sm-12">
                       botão adionar produto
                    </div> 
                </div>
            </div>
        </div>
    </div>
@stop

@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Estoque @parent
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
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('estoque.index') }}">Estoque</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('estoque.show', $estoque->id) }}">{{$estoque->produto->nome_produto}}</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="mt-2">Estoque</h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="card-body">
                <div class="form-body">
                    <h3>Estoque</h3>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-4 control-label">Modelo:</label>
                                    <div class="col-sm-8">
                                        <p class="form-control-static"><strong>{{$estoque->produto->modelo}}</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-4 control-label">Produto:</label>
                                    <div class="col-sm-8">
                                        <p class="form-control-static"><strong>{{$estoque->produto->nome_produto}}</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-4 control-label">Cor:</label>
                                    <div class="col-sm-4">
                                        <p class="form-control-static"><strong>{{$estoque->cor}}</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-4 control-label">Preço de venda:</label>
                                    <div class="col-sm-4">
                                        <p class="form-control-static"><strong>{{!$estoque->preco_venda ? "Não informado": 'R$ '.number_format($estoque->preco_venda, 2, ',', '.')}}</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-4 control-label">Sub Grupo:</label>
                                    <div class="col-sm-4">
                                        <p class="form-control-static"><strong>{{$estoque->produto->subGrupo->nome}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
    <script>
        $(document).ready(function($){
            $('.dinheiro').mask('#.###,00', {reverse: true}); 
        }); 

    </script>
@endpush

@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Estoques @parent
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
            <a href="{{route('estoque.index')}}">Estoques</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">  
            <h1 class="mt-2">estoques
                <a href="{{route('produto.index')}}" class="btn btn-info mb-5 pb-5 float-right">
                    <i class="fas fa-plus-square"></i> ADICIONAR UM NOVO PRODUTO
                </a>
            </h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="table-responsive">
                    @if ($estoques->count() != 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">#</th>
                                    <th class="border-top-0" scope="col">Produto</th>
                                    <th class="border-top-0" scope="col">Valor venda</th>
                                    <th class="border-top-0" scope="col">Valor compra</th>
                                    <th class="border-top-0" scope="col">Cor</th>
                                    <th class="border-top-0" scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estoques as $estoque)
                                    <tr>
                                        <th scope="row">{{$estoque->produto->modelo}}</th>
                                        <th scope="row">{{$estoque->produto->nome_produto}}</th>
                                        <td>{{!$estoque->preco_venda ? "Não informado": 'R$ '.number_format($estoque->preco_venda, 2, ',', '.')}}</td>
                                        <td>{{!$estoque->preco_compra ? "Não informado": 'R$ '.number_format($estoque->preco_compra, 2, ',', '.')}}</td>
                                        <td>{{$estoque->cor}}</td>
                                        <td>{{$estoque->status->nome}}</td>
                                        <td style="width: 250px">
                                            <a href="{{route('estoque.edit', $estoque->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{route('estoque.show', $estoque->id)}}" class="btn btn-success">Ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            @if (isset($filtros))
                                {!! $estoques->links()!!}
                            @else
                                {!! $estoques->links()!!}
                            @endif
                        </div>
                    @else
                        <h1>Ops ainda não foi cadastrado nenhum produto em estoque</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

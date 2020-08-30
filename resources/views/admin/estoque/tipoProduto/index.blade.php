@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Tipo de produtos @parent
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
            <a href="{{route('tipo-produto.index')}}">Tipo de produtos</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">  
            <h1 class="mt-2">Tipo de produtos<a href="{{route('tipo-produto.create')}}" class="btn btn-info mb-5 pb-5 float-right"><i class="fas fa-plus-square"></i> ADICIONAR</a></h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="table-responsive">
                    @if ($tipoProdutos->count() != 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Codigo</th>
                                    <th class="border-top-0" scope="col">Sigla</th>
                                    <th class="border-top-0" scope="col">Tipo Produto</th>
                                    <th class="border-top-0" scope="col">Descrição</th>
                                    <th class="border-top-0" scope="col">ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tipoProdutos as $tipoProduto)
                                    <tr>
                                        <th scope="row">{{$tipoProduto->id}}</th>
                                        <th scope="row">{{$tipoProduto->sigla}}</th>
                                        <td>{{$tipoProduto->nome}}</td>
                                        <td>{{!$tipoProduto->descricao ? "Não informado": $tipoProduto->descricao}}</td>
                                        <td style="width: 250px">
                                            <a href="{{route('tipo-produto.edit', $tipoProduto->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{route('tipo-produto.show', $tipoProduto->id)}}" class="btn btn-success">Ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            @if (isset($filtros))
                                {!! $tipoProdutos->links()!!}
                            @else
                                {!! $tipoProdutos->links()!!}
                            @endif
                        </div>
                    @else
                        <h1>Ops ainda não foi cadastrado nenhuma tipoProduto</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

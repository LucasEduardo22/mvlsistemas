@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Produtos @parent
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
            <a href="{{route('produto.index')}}">Produtos</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">  
            <h1 class="mt-2">Produtos<a href="{{route('produto.create')}}" class="btn btn-info mb-5 pb-5 float-right"><i class="fas fa-plus-square"></i> ADICIONAR</a></h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="table-responsive">
                    @if ($produtos->count() != 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Modelo</th>
                                    <th class="border-top-0" scope="col">Produto</th>
                                    <th class="border-top-0" scope="col">Categoria</th>
                                    <th class="border-top-0" scope="col">Tipo Produto</th>
                                    <th class="border-top-0" scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produtos as $produto)
                                    <tr>
                                        <th scope="row">{{$produto->modelo}}</th>
                                        <th scope="row">{{$produto->nome_produto}}</th>
                                        <td>{{$produto->categoria->nome}}</td>
                                        <td>{{$produto->tipoProduto->nome}}</td>
                                        <td>{{$produto->status->nome}}</td>
                                        <td style="width: 280px">
                                            <a href="{{route('produto.edit', $produto->id)}}" class="btn btn-info">Edit</a>
                                            @if (!$produto->estoque->id)
                                                <a href="{{route('estoque.create', $produto->id)}}" class="btn btn-success"><i class="fas fa-layer-group"></i></a>
                                            @else
                                                <a href="{{route('estoque.edit', $produto->estoque->id)}}" class="btn btn-success"><i class="fas fa-layer-group"></i></a>
                                            @endif
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            @if (isset($filtros))
                                {!! $produtos->links()!!}
                            @else
                                {!! $produtos->links()!!}
                            @endif
                        </div>
                    @else
                        <h1>Ops ainda não foi cadastrado nenhum produto</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

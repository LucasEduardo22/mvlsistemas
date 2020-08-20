@extends('layouts.template')

@section('content')
@include('includes.alert')

<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Visualizar o produto</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Produto</li>
                    <li class="breadcrumb-item active">{{$produto->nome}}</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="card" >
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <p><strong> Nome: </strong>{{$produto->nome}}</p>
                    <p><strong> Tamanho: </strong>{{$produto->tamanho->nome}}</p>
                    <p><strong> Tipo do Produto: </strong>{{$produto->tipoproduto->descricao}}</p>
                </div>
                <div class="col-6">
                    <p><strong> Codigo Referência: </strong> {{$produto->codigo_referencia}}</p>
                    <p><strong> Unidade: </strong>{{$produto->unidade->descricao}}</p>
                    <p><strong> Categoria: </strong>{{$produto->categoria->nome}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Tabela de Preco @parent
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
            <a href="{{route('tabela-preco.index')}}">Tabela de Preco</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">  
            <h1 class="mt-2">Tabela de Preco<a href="{{route('tabela-preco.create')}}" class="btn btn-primary float-right"><i class="fas fa-plus-square"></i> ADICIONAR</a></h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="table-responsive">
                    @if ($tabelaPrecos->count() != 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Codigo</th>
                                    <th class="border-top-0" scope="col">Nome</th>
                                    <th class="border-top-0" scope="col">Percentual</th>
                                    <th class="border-top-0" scope="col">Descrição</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tabelaPrecos as $tabelaPreco)
                                    <tr>
                                        <th scope="row">{{$tabelaPreco->id}}</th>
                                        <td>{{$tabelaPreco->nome}}</td>
                                        <td>{{$tabelaPreco->ganho ?? "Não informado"}}</td>
                                        <td>{{!$tabelaPreco->descricao ? "Não informado": $tabelaPreco->descricao}}</td>
                                        <td style="width: 250px">
                                            <div class="row">
                                                <a href="{{route('tabela-preco.edit', $tabelaPreco->id)}}" class="btn btn-info mr-2">Edit</a>
                                                <form action="{{route('tabela-preco.destroy', $tabelaPreco->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            @if (isset($filtros))
                                {!! $tabelaPrecos->links()!!}
                            @else
                                {!! $tabelaPrecos->links()!!}
                            @endif
                        </div>
                    @else
                        <h1>Ops ainda não foi cadastrado nenhum tabelaPreco</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

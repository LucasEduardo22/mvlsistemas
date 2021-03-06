@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Matéria Prima @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <!-- page vendors -->
    <link href="{{ asset('css/pages.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo.css') }}">
    <!--end of page vendors -->
@stop
@section('content')
    @include('includes.alert')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{route('materia-prima.index')}}">Matéria Prima</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">  
            <h1 class="mt-2">Matéria Prima<a href="{{route('materia-prima.create')}}" class="btn btn-primary float-right mr-2"><i class="fas fa-plus-square"></i> ADICIONAR</a></h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
        <div class = "col-md-12">
            @csrf
            <div class = "row">
                <div class= "col-md-10">    
                    <input type="text" class="form-control" id="filtrar" value="{{$filtros['filtrar'] ?? ''}}" name="filtrar" placeholder = "Pesquisar por"> 
                </div>
                <div class= "col-md-2">
                    <button type="submit" class= "btn btn-success btn-block" >Pesquisar</button>
                </div>
            </div>
        </div>
        <div class="card-body"
            <div class="col-md-12">
                <div class="table-responsive">
                    @if ($materiaPrimas->count() != 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Código</th>
                                    <th class="border-top-0" scope="col">Matéria Prima</th>
                                    <th class="border-top-0" scope="col">Grupo</th>
                                    <th class="border-top-0" scope="col">Quantidade</th>
                                    <th class="border-top-0" scope="col">Valor de Compra</th>
                                    <th class="border-top-0" scope="col">Margem Venda</th>
                                    <th class="border-top-0" scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($materiaPrimas as $materiaPrima)
                                    <tr>
                                        <td scope="row">{{$materiaPrima->id}}</td>
                                        <td style="widtd: 300px">{{$materiaPrima->nome}}</td>
                                        <td>{{$materiaPrima->tipoProduto->nome}}</td>
                                        <td>{{$materiaPrima->estoque_atual ?? "0"}}</td>
                                        <td>{{!$materiaPrima->preco_compra ? "R$ 0" : 'R$ '.number_format($materiaPrima->preco_compra, 2, ',', '.')}}</td>
                                        <td>{{!$materiaPrima->marge_venda ? "0%" : $materiaPrima->marge_venda."%"}}</td>
                                        <td>{{$materiaPrima->status->nome}}</td>
                                        <td style="width: 150px">
                                            <a href="{{route('materia-prima.edit', $materiaPrima->id)}}" class="btn btn-info">Edit</a>
                                            {{-- <a href="{{route('materia-prima.show', $materiaPrima->id)}}"  class="btn bg-warning-dark">ver</a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            @if (isset($filtros))
                                {!! $materiaPrimas->links()!!}
                            @else
                                {!! $materiaPrimas->links()!!}
                            @endif
                        </div>
                    @else
                        <h1>Ops, ainda não foi cadastrado nenhum materia-prima</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

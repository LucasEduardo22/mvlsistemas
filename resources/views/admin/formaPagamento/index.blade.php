@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Forma  de Pagamentos @parent
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
            <a href="{{route('forma-pagamento.index')}}">Forma  de Pagamentos</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">  
            <h1 class="mt-2">Forma  de Pagamentos<a href="{{route('forma-pagamento.create')}}" class="btn btn-primary float-right"><i class="fas fa-plus-square"></i> ADICIONAR</a></h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="table-responsive">
                    @if ($formaPagamentos->count() != 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Codigo</th>
                                    <th class="border-top-0" scope="col">Forma  de Pagamento</th>
                                    <th class="border-top-0" scope="col">Quantidade de Parcelas</th>
                                    <th class="border-top-0" scope="col">Juros%</th>
                                    <th class="border-top-0" scope="col">ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($formaPagamentos as $formaPagamento)
                                    <tr>
                                        <th scope="row">{{$formaPagamento->id}}</th>
                                        <td>{{$formaPagamento->nome}}</td>
                                        <td>{{$formaPagamento->parcelas ?? "Não informado"}}</td>
                                        <td>{{!$formaPagamento->juros_parcelas ? "Não informado": $formaPagamento->juros_parcelas}}</td>
                                        <td style="width: 250px">
                                            <a href="{{route('forma-pagamento.edit', $formaPagamento->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{route('forma-pagamento.show', $formaPagamento->id)}}" class="btn btn-success">Ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            @if (isset($filtros))
                                {!! $formaPagamentos->links()!!}
                            @else
                                {!! $formaPagamentos->links()!!}
                            @endif
                        </div>
                    @else
                        <h1>Ops ainda não foi cadastrado nenhum formaPagamento</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

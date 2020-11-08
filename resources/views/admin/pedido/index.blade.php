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
            <a href="{{route('pedido.index')}}">Pedidos</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">  
            <h1 class="mt-2">Pedidos<a href="{{route('pedido.create')}}" class="btn mr-2 btn-primary float-right"><i class="fas fa-plus-square"></i> CRIAR PEDIDO</a></h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class = "col-md-12">
                <form action="{{route('pedido.search')}}" method="post">
                    @csrf
                    <div class = "row">
                        <div class= "col-md-10">    
                            <input type="text" class="form-control" id="filtrar" value="{{$filtros['filtrar'] ?? ''}}" name="filtrar" placeholder = "pesquisar por"> 
                        </div>
                        <div class= "col-md-2">
                            <button type="submit" class= "btn btn-success btn-block" >Pesquisar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    {{-- @if ($pedidos->count() != 0) --}}
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Código</th>
                                    <th class="border-top-0" scope="col">Cliente</th>
                                    <th class="border-top-0" scope="col">Situação</th>
                                    <th class="border-top-0" scope="col">Vedendor</th>
                                    <th class="border-top-0" scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pedidos as $pedido)
                                    <tr>
                                        <th scope="row">{{$pedido->id}}</th>
                                        <th>{{$pedido->cliente->nome}}</th>
                                        <th>{{$pedido->status->nome}}</th>
                                        <th>{{$pedido->vendedor->name}}</th>
                                        <td style="width: 250px">
                                            @if ($pedido->status_id != 3)
                                                <a href="{{route('pedido.edit', $pedido->id)}}" class="btn btn-info">Edit</a>  
                                            @endif
                                            <a href="{{-- {{route('pedido.show', $pedido->id)}} --}}" class="btn btn-success">ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            @if (isset($filtros))
                                {!! $pedidos->links()!!}
                            @else
                                {!! $pedidos->links()!!}
                            @endif
                        </div>
                   {{--  @else
                        <h1>Ops ainda não foi cadastrado nenhum pedido</h1>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
    <script>
        $(document).ready(function($){
            $('.cpf_cnpj').mask('00.000.000/0000-00');
            $('.cep').mask("99999-999");
            //$('.ie').mask("999.99999-99");
            $('.telefone').mask('(99) 9999-9999'); 
            $('.celular').mask('(99) 99999-9999'); 
            
        }); 

    </script>
@endpush 

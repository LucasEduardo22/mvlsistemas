@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Clientes @parent
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
            <a href="{{route('cliente.index')}}">Clientes</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">  
            <h1 class="mt-2">Clientes<a href="{{route('cliente.create')}}" class="btn btn-info mb-5 pb-5 float-right"><i class="fas fa-plus-square"></i> ADICIONAR</a></h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="table-responsive">
                    {{-- @if ($clientes->count() != 0) --}}
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Nome Fantasia</th>
                                    <th class="border-top-0" scope="col">Razão Social</th>
                                    <th class="border-top-0" scope="col">CNPJ</th>
                                    <th class="border-top-0" scope="col">Telefone</th>
                                    <th class="border-top-0" scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                    <tr>
                                        <th scope="row">{{$cliente->nome}}</th>
                                        <th scope="row">{{$cliente->razao_social}}</th>
                                        <td >{{$cliente->cpf_cnpj}}</td>
                                        <td>{{$cliente->telefone}}</td>
                                        <td style="width: 250px">
                                            <a href="{{route('cliente.edit', $cliente->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{route('cliente.show', $cliente->id)}}" class="btn btn-success">ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            @if (isset($filtros))
                                {!! $clientes->links()!!}
                            @else
                                {!! $clientes->links()!!}
                            @endif
                        </div>
                   {{--  @else
                        <h1>Ops ainda não foi cadastrado nenhum cliente</h1>
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
            $('.ie').mask("999.99999-99");
            $('.telefone').mask('(99) 9999-9999'); 
            $('.celular').mask('(99) 99999-9999'); 
            
        }); 

    </script>
@endpush 

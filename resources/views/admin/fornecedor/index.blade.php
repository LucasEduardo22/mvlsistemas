@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Fornecedores @parent
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
            <a href="{{route('fornecedor.index')}}">Fornecedores</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">  
            <h1 class="mt-2">Fornecedores<a href="{{route('fornecedor.create')}}" class="btn btn-info mb-5 pb-5 float-right"><i class="fas fa-plus-square"></i> ADICIONAR</a></h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class = "col-md-12">
                <form action="{{route('fornecedor.search')}}" method="post">
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
                    {{-- @if ($fornecedors->count() != 0) --}}
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Código</th>
                                    <th class="border-top-0" scope="col">Nome Fantasia</th>
                                    <th class="border-top-0" scope="col">Razão Social</th>
                                    <th class="border-top-0" scope="col">CNPJ</th>
                                    <th class="border-top-0" scope="col">Telefone</th>
                                    <th class="border-top-0" scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fornecedors as $fornecedor)
                                    <tr>
                                        <th scope="row">{{$fornecedor->id}}</th>
                                        <th scope="row">{{$fornecedor->nome}}</th>
                                        <th scope="row">{{$fornecedor->razao_social}}</th>
                                        <td class="cpf_cnpj">{{$fornecedor->cpf_cnpj}}</td>
                                        <td class="telefone" style="width: 180px">{{$fornecedor->telefone}}</td>
                                        <td style="width: 250px">
                                            <a href="{{route('fornecedor.edit', $fornecedor->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{route('fornecedor.show', $fornecedor->id)}}" class="btn btn-success">ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            @if (isset($filtros))
                                {!! $fornecedors->links()!!}
                            @else
                                {!! $fornecedors->links()!!}
                            @endif
                        </div>
                   {{--  @else
                        <h1>Ops ainda não foi cadastrado nenhum fornecedor</h1>
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

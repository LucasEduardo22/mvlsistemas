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
            <a href="{{route('pedido.create')}}">Pedido</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">  
            
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="row">
                    <div class="card col-sm-8">
                        <div class="card-body">
                            <div class="row">
                                <div class="row col-6">
                                    <label for="">Tipo do Pedido:</label>
                                    <div class="ml-2 form-group">
                                        <div class="form-check">
                                            <input class="form-check-input " type="radio" name="tipo_venda" id="gridRadios2"
                                                value="V" checked="">
                                            <label class="form-check-label " for="gridRadios1">
                                                Venda
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group ml-4">
                                        <div class="form-check ">
                                            <input class="form-check-input cpf-cnpj" type="radio" name="tipo_venda" id="gridRadios1"
                                                value="O">
                                            <label class="form-check-label" for="gridRadios2">
                                                Orçamento
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-6">
                                    <label for="">status:</label>
                                    <div class="form-group ml-4">
                                        <div class="form-check ">
                                            <label class="form-check-label text-success" for="gridRadios2">
                                                Pendente
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este conteúdo é um pouco maior, para demonstração.</p>
                            <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p>
                        </div>
                    </div> 
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-header">
                                <div class = "row">
                                    <form action="{{route('cliente.search')}}" method="post">
                                        @csrf
                                        <div class = "row">
                                            <div class= "col-md-10"> 
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                      <div class="input-group-text bg-success"><i class="fas fa-search"></i></div>
                                                    </div>
                                                    <input type="text" class="form-control" id="filtrar" value="{{$filtros['filtrar'] ?? ''}}" name="filtrar" placeholder = "codigo ou CNPJ"> 
                                                </div>     
                                            </div>
                                        </div>
                                    </form>
                                    <button class="btn btn-primary float-right" data-toggle="modal" data-target=".bd-example-modal-xl"><i class="fas fa-plus-square"></i> ADD</button>
                                    @include('admin.pedido.modal.cliente')
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="client_id">
                                <ul class="list-unstyled">
                                    <li>Cliente: <strong>Raimunda e Felipe Limpeza Ltda</strong></li>
                                    <li>CNPJ: <strong>88.452.358/0001-04</strong></li>
                                    <li>Telefone: <strong>(11) 98489-8033</strong></li>
                                    <li>Celular: <strong>(11) 98489-8033</strong></li>
                                    <li>Cidade: <strong>Mogi das Cruzes</strong></li>
                                    <li>Estado: <strong>São Paulo</strong></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="card-body">
                            <h5 class="card-title">Título do card</h5>
                            <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este conteúdo é um pouco maior, para demonstração.</p>
                            <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p>
                        </div>
                    </div> 
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
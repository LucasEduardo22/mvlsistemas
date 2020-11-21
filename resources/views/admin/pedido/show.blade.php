@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Cliente @parent
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
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('pedido.index') }}">Pedido</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('pedido.show', $pedido->id) }}">Dados do pedido</a>
        </li>
    </ol>
    <div class="card mr-1">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="mt-2">Pedido</h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            @include('admin.pedido._partials._show')   
        </div>
    </div>
@stop
@push('scripts')
    <script>
        $(document).ready(function($){
            $('#cpf_cnpj').mask('00.000.000/0000-00');
            $('#cep').mask("99999-999");
            //$('#ie').mask("999.99999-99");
            $('#telefone').mask('(99) 9999-9999'); 
            $('#celular').mask('(99) 99999-9999'); 
            
        }); 
    </script>
@endpush 

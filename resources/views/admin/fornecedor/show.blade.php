@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Fornecedor @parent
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
            <a href="{{ route('fornecedor.index') }}">Fornecedores</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('fornecedor.create') }}">Create</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="mt-2">fornecedor</h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="card-body">
                @include('admin.fornecedor._partials._show')    
            </div>
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

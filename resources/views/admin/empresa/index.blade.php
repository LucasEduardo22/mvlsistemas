@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Empresas @parent
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
            <a href="{{route('empresa.index')}}">Empresas</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">  
            <h1>Empresa</h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
           
            <div class="col-md-12">
                @if (empty($empresa))
                    <h1 class="mt-2"><a href="{{route('empresa.create')}}" class="btn btn-primary float-right"><i class="fas fa-plus-square"></i> ADICIONAR</a></h1>
                @else  
                    @include('admin.empresa._partials._show')  
                @endif
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

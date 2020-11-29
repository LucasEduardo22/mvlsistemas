@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Cadastrar um novo produto @parent
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
            <a href="{{ route('produto.index') }}">Produtos</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('produto.show', $produto->id) }}">{{$produto->nome_produto}}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('produto.edit',  $produto->id) }}">Editar</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="mt-2">Edita</h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="card-body">
                <form action="{{route('produto.materia-prima.estoque.update', $produto->id)}}" class="form-horizontal" method="post" class="form" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    @include('admin.estoque.produto.ficha-tecnica.form')
                </form>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        $(document).ready(function($){
           
            $('._ave').click(function(){
                var campo = $(this).val();
                console.log(campo);	
                if (campo != 0) {
                    $("._detalhe").show();
                } else {
                    $("._detalhe").hide();
                }	
                
            });
            
        }); 

    </script>
@endpush 

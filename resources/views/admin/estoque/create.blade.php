@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Adicinar o produto Estoque @parent
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
            <a href="{{ route('estoque.index') }}">Estoque</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('estoque.create', $produto->id) }}">ADD</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('produto.edit', $produto->id) }}">Produto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('produto.materia-prima.edit', $produto->id)}}">Aviamentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="">Estoque</a>
                </li>
            </ul>
            <small class="float-right mr-5">status: <strong class="text-success">{{$produto->status->nome}}</strong></small>
            <h1 class="mt-2">Adicionar o produto no estoque</h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="card-body">
                <form action="{{route('estoque.store', $produto->id)}}" class="form-horizontal" method="post" class="form">
                    @method('POST')
                    @csrf
                    @include('admin.estoque._form')
                </form>
            </div>
        </div>
    </div>
@stop
@push('scripts')
    <script>
        $(document).ready(function($){
            var peso_metro = $('[name="metro_kilo"]:checked').val()
            if (peso_metro == "M"){
                $("#_valor_tecido_principal").maskMoney({ decimal: ',', thousands: '.', precision: 2 });
                $("#_valor_tecido_secundario").maskMoney({ decimal: ',', thousands: '.', precision: 2 });
                $("#_valor_tecido_terciario").maskMoney({ decimal: ',', thousands: '.', precision: 2 });
            }
            else if (peso_metro == "P"){
                $("#_valor_tecido_principal").maskMoney({ decimal: ',', thousands: '.', precision: 3 });
                $("#_valor_tecido_secundario").maskMoney({ decimal: ',', thousands: '.', precision: 3 });
                $("#_valor_tecido_terciario").maskMoney({ decimal: ',', thousands: '.', precision: 3 });
            }	
            $('.dinheiro').mask('#.###,00', {reverse: true}); 
            $('.metro_kilo').change(function(){
                var campo = $(this).val();
                if (campo == "M"){
                    $("#_valor_tecido_principal").maskMoney({ decimal: ',', thousands: '.', precision: 2 });
                    $("#_valor_tecido_secundario").maskMoney({ decimal: ',', thousands: '.', precision: 2 });
                    $("#_valor_tecido_terciario").maskMoney({ decimal: ',', thousands: '.', precision: 2 });
                }
                else if (campo == "P"){
                    $("#_valor_tecido_principal").maskMoney({ decimal: ',', thousands: '.', precision: 3 });
                    $("#_valor_tecido_secundario").maskMoney({ decimal: ',', thousands: '.', precision: 3 });
                    $("#_valor_tecido_terciario").maskMoney({ decimal: ',', thousands: '.', precision: 3 });
                }			
            });
        }); 

    </script>
@endpush
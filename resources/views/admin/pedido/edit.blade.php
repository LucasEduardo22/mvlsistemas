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
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('pedido.index') }}">Pedido</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('pedido.edit', $pedido->id) }}">Editar</a>
        </li>
    </ol>
    <form action="{{route('pedido.update', $pedido->id)}}" class="form-horizontal" method="post" class="form" enctype="multipart/form-data">
        @method('POST')
        @csrf
        @include('admin.pedido._partials.editFrom')
    </form>
@stop
@push('scripts')
    @include('admin.pedido.script-edit') 
    <script>
        $(document).ready(function($) {
            $("#_codigo").maskMoney({precision: 3, decimal: ''});
            //declaro uma var para somar o total tela pedido
            var qtd_total = 0;
            var valor_total = 0;

            //faço um foreach percorrendo todos os inputs com a class soma e faço a soma na var criada acima
            $(".qtd_produto").each(function(){
                qtd_total = qtd_total + Number($(this).val());  
            });

            $(".valor_produto").each(function(){
               valor_total = valor_total + Number($(this).val());  
            });

            console.log(qtd_total);
            //$("#_valor_itens").html(valor_total.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
            $('#_qtd_itens').html(qtd_total + " Peças"); 
            $("#_valor_itens").html(valor_total.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
        });
    </script>
@endpush

@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Editar materia prima {{$materiaPrima->nome}} @parent
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
            <a href="{{ route('materia-prima.index') }}">Materia Primas</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('materia-prima.edit', $materiaPrima->id) }}">{{$materiaPrima->nome}}</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="mt-2">Editar materia prima <strong>{{$materiaPrima->nome}}</strong></h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="card-body">
                <form action="{{route('materia-prima.update', $materiaPrima->id)}}" class="form-horizontal" method="post" class="form" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    @include('admin.estoque.materia-prima._partials.form')
                </form>
            </div>
        </div>
    </div>
@stop
@push('scripts')
    <script>
        $(document).ready(function($){
            $('.dinheiro').mask('#.###,00', {reverse: true}); 

            $('.tipo_produto').change(function (){
                var tipo = $('.tipo_produto option:selected').text();
                console.log(tipo);

                if (tipo == "Tecido") {
                    $('.tecidos').show();
                    $("_tipo_materia").val(1);
                }else{
                    $('.tecidos').hide();
                    $("_tipo_materia").val(0);
                }
            });
        });
    </script>
@endpush

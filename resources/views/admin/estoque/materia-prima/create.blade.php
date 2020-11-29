@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Meteria Prima @parent
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
            <a href="{{ route('materia-prima.index') }}">Matéria Prima</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('materia-prima.create') }}">Create</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Matéria Prima</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Fornernecedor</a>
                </li>
            </ul>
            <h1 class="mt-2"></h1>
        </section>
        <div class="card-body pt-0">
            <form action="{{route('materia-prima.store')}}" class="form-horizontal" method="post" class="form" enctype="multipart/form-data">
                @method('POST')
                @csrf
                @include('admin.estoque.materia-prima._partials.form')
            </form>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        $(document).ready(function($){
            $('.tecidos').hide();
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
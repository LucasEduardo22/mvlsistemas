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
            <a href="{{ route('produto.create') }}">Create</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Produto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Aviamentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Estoque</a>
                </li>
            </ul>
            <h1 class="mt-2">Cadastrar um novo produto</h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="card-body">
                <form action="{{route('produto.store')}}" class="form-horizontal" method="post" class="form" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    @include('admin.estoque.produto._partials.form')
                </form>
            </div>
        </div>
    </div>
@stop
@push('scripts')
    <script>
        $(document).ready(function($){
            $('#_image').change(function(){
                const file = $(this)[0].files[0];
                const fileReader = new FileReader();

                fileReader.onloadend = function(){
                    $("#_img").attr('src', fileReader.result);
                    console.log(fileReader.result)
                }
                fileReader.readAsDataURL(file)
                
            });
            
        }); 

    </script>
@endpush 
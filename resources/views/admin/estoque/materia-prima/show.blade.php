@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Produto @parent
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
            <a href="{{ route('produto.create') }}">{{$produto->nome_produto}}</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="mt-2">produto</h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="card-body">
                @include('admin.estoque.produto._partials._show')    
            </div>
        </div>
    </div>
@stop
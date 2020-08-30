@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Cadastrar uma novo Tipo @parent
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
            <a href="{{ route('tipo-produto.index') }}">Tipo de produtos</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('tipo-produto.create') }}">Create</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="mt-2">Cadastrar uma novo Tipo de produtos</h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="card-body">
                <form action="{{route('tipo-produto.store')}}" class="form-horizontal" method="post" class="form">
                    @method('POST')
                    @csrf
                    @include('admin.estoque.tipoProduto._partials.form')
                </form>
            </div>
        </div>
    </div>
@stop

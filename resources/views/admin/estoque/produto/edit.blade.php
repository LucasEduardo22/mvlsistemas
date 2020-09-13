@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Editar produto {{$produto->nome}} @parent
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
            <a href="{{ route('produto.edit', $produto->id) }}">{{$produto->nome_produto}}</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="mt-2">Editar produto <strong>{{$produto->nome_produto}}</strong></h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="card-body">
                <form action="{{route('produto.update', $produto->id)}}" class="form-horizontal" method="post" class="form">
                    @method('PUT')
                    @csrf
                    @include('admin.estoque.produto._partials.form')
                </form>
            </div>
        </div>
    </div>
@stop

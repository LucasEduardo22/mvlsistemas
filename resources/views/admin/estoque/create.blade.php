@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Adicinar o produto {{$produto->nome_produto}} Estoque @parent
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
            <a href="{{ route('estoque.create', $produto->id) }}">{{$produto->nome_produto}}</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <small class="float-right mr-5">status: <strong class="text-success">{{$produto->status->nome}}</strong></small>
            <h1 class="mt-2">Adicionar o produto <strong>{{$produto->nome_produto}}</strong> no estoque</h1>
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

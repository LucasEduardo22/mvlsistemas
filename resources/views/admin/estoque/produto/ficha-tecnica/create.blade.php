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
        <li class="nav-item">
            <a class="nav-link" href="{{ route('produto.edit', $produto->id) }}">Produto</a>
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
                    <a class="nav-link" href="{{ route('produto.edit', $produto->id) }}">Produto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Aviamentos</a>
                </li>
                <li class="nav-item">
                    @if (!empty($produto->estoque))
                        <a class="nav-link" href="{{route('estoque.edit', $produto->estoque->id)}}">Estoque</a>
                    @else
                        <a class="nav-link" href="#">Estoque</a>
                    @endif
                </li>
            </ul>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="card-body">
                <form action="{{route('produto.materia-prima.estoque.store', $produto->id)}}" class="form-horizontal" method="post" class="form" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    @include('admin.estoque.produto.ficha-tecnica.form')
                </form>
            </div>
        </div>
    </div>
@stop



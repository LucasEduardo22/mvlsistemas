@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Editar o aviamento {{$aviamento->nome}} @parent
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
            <a href="{{ route('aviamento.index') }}">aviamentos</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('aviamento.edit', $aviamento->id) }}">{{$aviamento->nome}}</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="#">Produto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="">Aviamentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Estoque</a>
                </li>
            </ul>
            <h1 class="mt-2"><strong>{{$aviamento->nome}}</strong></h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="card-body">
                <form action="{{route('aviamento.update', $aviamento->id)}}" class="form-horizontal" method="post" class="form">
                    @method('PUT')
                    @csrf
                    @include('admin.estoque.aviamento._partials.form')
                </form>
            </div>
        </div>
    </div>
@stop

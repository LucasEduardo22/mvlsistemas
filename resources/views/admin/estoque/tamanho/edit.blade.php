@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Editar a Tamanho {{$tamanho->nome}} @parent
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
            <a href="{{ route('tamanho.index') }}">Tamanho</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('tamanho.edit', $tamanho->id) }}">{{$tamanho->nome}}</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="mt-2">Editar a tamanho <strong>{{$tamanho->nome}}</strong></h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="card-body">
                <form action="{{route('tamanho.update', $tamanho->id)}}" class="form-horizontal" method="post" class="form">
                    @method('PUT')
                    @csrf
                    @include('admin.estoque.tamanho._partials.form')
                </form>
            </div>
        </div>
    </div>
@stop

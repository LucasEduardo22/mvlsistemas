@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Editar a Unidade de medida{{$unidade->nome}} @parent
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
            <a href="{{ route('unidade.index') }}">Unidade de medida</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('unidade.edit', $unidade->id) }}">{{$unidade->nome}}</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="mt-2">Editar a Unidade de medida <strong>{{$unidade->nome}}</strong></h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="card-body">
                <form action="{{route('unidade.update', $unidade->id)}}" class="form-horizontal" method="post" class="form">
                    @method('PUT')
                    @csrf
                    @include('admin.estoque.unidade._partials.form')
                </form>
            </div>
        </div>
    </div>
@stop

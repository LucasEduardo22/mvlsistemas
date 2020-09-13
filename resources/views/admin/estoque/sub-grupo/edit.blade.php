@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Editar Sub Grupo {{$subGrupo->nome}} @parent
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
            <a href="{{ route('sub-grupo.index') }}">Sub Grupos</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('sub-grupo.edit', $subGrupo->id) }}">{{$subGrupo->nome}}</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="mt-2">Editar Sub Grupo <strong>{{$subGrupo->nome}}</strong></h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="card-body">
                <form action="{{route('sub-grupo.update', $subGrupo->id)}}" class="form-horizontal" method="post" class="form">
                    @method('PUT')
                    @csrf
                    @include('admin.estoque.sub-grupo._partials.form')
                </form>
            </div>
        </div>
    </div>
@stop

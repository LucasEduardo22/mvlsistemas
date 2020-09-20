@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Cadastrar uma novo aviamento @parent
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
            <a href="{{ route('aviamento.create') }}">Create</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="mt-2">Cadastrar uma nova aviamento</h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="card-body">
                <form action="{{route('aviamento.store')}}" class="form-horizontal" method="post" class="form">
                    @method('POST')
                    @csrf
                    @include('admin.estoque.aviamento._partials.form')
                </form>
            </div>
        </div>
    </div>
@stop

@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Grades @parent
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
            <a href="{{route('home')}}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{route('fornecedor.index')}}">Grades</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">  
            <h1 class="mt-2">Grades</h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="card">
                    <h1>Masculino</h1>
                    <img src="{{ asset('img/images/grademasc.jpg') }}" class="img-fluid" alt="Imagem responsiva">
                </div><br><br>
                <div class="card mt-8">
                    <h1>Feminino</h1>
                    <img src="{{ asset('img/images/gradefem.jpg') }}" class="img-fluid" alt="Imagem responsiva">
                </div>
            </div>
        </div>
    </div>
@stop

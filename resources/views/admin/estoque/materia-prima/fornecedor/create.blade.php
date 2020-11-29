@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Meteria Prima @parent
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
            <a href="{{ route('materia-prima.fornecedor.create.index') }}">Materia Primas</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('materia-prima.fornecedor.create.create') }}">Create</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link" href="#">Meteria Prima</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="">Fornernecedor</a>
                </li>
            </ul>
            <h1 class="mt-2"></h1>
        </section>
        <div class="card-body pt-0">
            <form class="form-horizontal" method="post" class="form">
                @method('POST')
                @csrf
                @include('admin.estoque.materia-prima.fornecedor.create._partials.form-fornecedor')
            </form>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        $(document).ready(function($){
            $('.dinheiro').mask('#.###,00', {reverse: true}); 
        }); 

    </script>
@endpush
@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Categoria @parent
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
            <a href="{{route('categoria.index')}}">Categorias</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">  
            <h1 class="mt-2">Categorias<a href="{{route('categoria.create')}}" class="btn btn-info mb-5 pb-5 float-right"><i class="fas fa-plus-square"></i> ADICIONAR</a></h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="table-responsive">
                    @if ($categorias->count() != 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Codigo</th>
                                    <th class="border-top-0" scope="col">Sigla</th>
                                    <th class="border-top-0" scope="col">Categoria</th>
                                    <th class="border-top-0" scope="col">Descrição</th>
                                    <th class="border-top-0" scope="col">ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categorias as $categoria)
                                    <tr>
                                        <th scope="row">{{$categoria->id}}</th>
                                        <th scope="row">{{$categoria->sigla}}</th>
                                        <td>{{$categoria->nome}}</td>
                                        <td>{{!$categoria->descricao ? "Não informado": $categoria->descricao}}</td>
                                        <td style="width: 250px">
                                            <a href="{{route('categoria.edit', $categoria->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{route('categoria.show', $categoria->id)}}" class="btn btn-success">Ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            @if (isset($filtros))
                                {!! $categorias->links()!!}
                            @else
                                {!! $categorias->links()!!}
                            @endif
                        </div>
                    @else
                        <h1>Ops ainda não foi cadastrado nenhuma categoria</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

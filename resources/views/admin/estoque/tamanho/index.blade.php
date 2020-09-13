@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Tamanho @parent
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
            <a href="{{route('tamanho.index')}}">Tamanho</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">  
            <h1 class="mt-2">Tamanho<a href="{{route('tamanho.create')}}" class="btn btn-info mb-5 pb-5 float-right"><i class="fas fa-plus-square"></i> ADICIONAR</a></h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="table-responsive">
                    @if ($tamanhos->count() != 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Codigo</th>
                                    <th class="border-top-0" scope="col">Sigla</th>
                                    <th class="border-top-0" scope="col">Tamanho</th>
                                    <th class="border-top-0" scope="col">Descrição</th>
                                    <th class="border-top-0" scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tamanhos as $tamanho)
                                    <tr>
                                        <th scope="row">{{$tamanho->id}}</th>
                                        <td>{{$tamanho->sigla}}</td>
                                        <td>{{$tamanho->nome}}</td>
                                        <td>{{!$tamanho->descricao ? "Não informado": $tamanho->descricao}}</td>
                                        <td style="width: 250px">
                                            <a href="{{route('tamanho.edit', $tamanho->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{route('tamanho.show', $tamanho->id)}}" class="btn btn-success">Ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            @if (isset($filtros))
                                {!! $tamanhos->links()!!}
                            @else
                                {!! $tamanhos->links()!!}
                            @endif
                        </div>
                    @else
                        <h1>Ops ainda não foi cadastrado nenhum tamanho</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Grupos @parent
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
            <a href="{{route('grupo.index')}}">Grupos</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">  
            <h1 class="mt-2">Grupos<a href="{{route('grupo.create')}}" class="btn btn-primary float-right"><i class="fas fa-plus-square"></i> ADICIONAR</a></h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="table-responsive">
                    @if ($grupos->count() != 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Codigo</th>
                                    <th class="border-top-0" scope="col">Sigla</th>
                                    <th class="border-top-0" scope="col">Grupo</th>
                                    <th class="border-top-0" scope="col">Departamento</th>
                                    <th class="border-top-0" scope="col">Descrição</th>
                                    <th class="border-top-0" scope="col">ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grupos as $grupo)
                                    <tr>
                                        <th scope="row">{{$grupo->id}}</th>
                                        <th scope="row">{{$grupo->sigla}}</th>
                                        <td>{{$grupo->nome}}</td>
                                        <td>{{$grupo->departamento->nome}}</td>
                                        <td>{{!$grupo->descricao ? "Não informado": $grupo->descricao}}</td>
                                        <td style="width: 250px">
                                            <a href="{{route('grupo.edit', $grupo->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{route('grupo.show', $grupo->id)}}" class="btn btn-success">Ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            @if (isset($filtros))
                                {!! $grupos->links()!!}
                            @else
                                {!! $grupos->links()!!}
                            @endif
                        </div>
                    @else
                        <h1>Ops ainda não foi cadastrado nenhum grupo</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

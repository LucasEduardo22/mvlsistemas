@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Sub Grupos @parent
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
            <a href="{{route('sub-grupo.index')}}">Sub Grupos</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">  
            <h1 class="mt-2">Sub Grupos<a href="{{route('sub-grupo.create')}}" class="btn btn-info mb-5 pb-5 float-right"><i class="fas fa-plus-square"></i> ADICIONAR</a></h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="table-responsive">
                    @if ($subGrupos->count() != 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Codigo</th>
                                    <th class="border-top-0" scope="col">Sigla</th>
                                    <th class="border-top-0" scope="col">Sub Grupo</th>
                                    <th class="border-top-0" scope="col">Grupo</th>
                                    <th class="border-top-0" scope="col">Descrição</th>
                                    <th class="border-top-0" scope="col">ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subGrupos as $subGrupo)
                                    <tr>
                                        <th scope="row">{{$subGrupo->id}}</th>
                                        <th scope="row">{{$subGrupo->sigla}}</th>
                                        <td>{{$subGrupo->nome}}</td>
                                        <td>{{$subGrupo->grupo->nome}}</td>
                                        <td>{{!$subGrupo->descricao ? "Não informado": $subGrupo->descricao}}</td>
                                        <td style="width: 250px">
                                            <a href="{{route('sub-grupo.edit', $subGrupo->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{route('sub-grupo.show', $subGrupo->id)}}" class="btn btn-success">Ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            @if (isset($filtros))
                                {!! $subGrupos->links()!!}
                            @else
                                {!! $subGrupos->links()!!}
                            @endif
                        </div>
                    @else
                        <h1>Ops ainda não foi cadastrado nenhum subGrupo</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

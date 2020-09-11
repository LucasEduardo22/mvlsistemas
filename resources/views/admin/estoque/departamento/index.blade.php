@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Departamentos @parent
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
            <a href="{{route('departamento.index')}}">Departamentos</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">  
            <h1 class="mt-2">Departamentos<a href="{{route('departamento.create')}}" class="btn btn-info mb-5 pb-5 float-right"><i class="fas fa-plus-square"></i> ADICIONAR</a></h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="table-responsive">
                    @if ($departamentos->count() != 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Codigo</th>
                                    <th class="border-top-0" scope="col">Sigla</th>
                                    <th class="border-top-0" scope="col">Departamento</th>
                                    <th class="border-top-0" scope="col">Descrição</th>
                                    <th class="border-top-0" scope="col">ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departamentos as $departamento)
                                    <tr>
                                        <th scope="row">{{$departamento->id}}</th>
                                        <th scope="row">{{$departamento->sigla}}</th>
                                        <td>{{$departamento->nome}}</td>
                                        <td>{{!$departamento->descricao ? "Não informado": $departamento->descricao}}</td>
                                        <td style="width: 250px">
                                            <a href="{{route('departamento.edit', $departamento->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{route('departamento.show', $departamento->id)}}" class="btn btn-success">Ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            @if (isset($filtros))
                                {!! $departamentos->links()!!}
                            @else
                                {!! $departamentos->links()!!}
                            @endif
                        </div>
                    @else
                        <h1>Ops ainda não foi cadastrado nenhum departamento</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

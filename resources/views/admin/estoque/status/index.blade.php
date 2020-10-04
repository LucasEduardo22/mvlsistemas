@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Status @parent
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
            <a href="{{route('status.index')}}">Status</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">  
            <h1 class="mt-2">Status<a href="{{route('status.create')}}" class="btn btn-primary float-right"><i class="fas fa-plus-square"></i> ADICIONAR</a></h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="table-responsive">
                    @if ($status->count() != 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Codigo</th>
                                    <th class="border-top-0" scope="col">Status</th>
                                    <th class="border-top-0" scope="col">Descrição</th>
                                    <th class="border-top-0" scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($status as $item)
                                    <tr>
                                        <th scope="row">{{$item->id}}</th>
                                        <td>{{$item->nome}}</td>
                                        <td>{{!$item->descricao ? "Não informado": $item->descricao}}</td>
                                        <td style="width: 250px">
                                            <a href="{{route('status.edit', $item->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{route('status.show', $item->id)}}" class="btn btn-success">Ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            @if (isset($filtros))
                                {!! $status->links()!!}
                            @else
                                {!! $status->links()!!}
                            @endif
                        </div>
                    @else
                        <h1>Ops ainda não foi cadastrado nenhuma status</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Usuarios @parent
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
            <a href="{{route('usuario.index')}}">Usuarios</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">  
            <h1 class="mt-2">Usuarios<a href="{{route('usuario.create')}}" class="btn btn-primary float-right"><i class="fas fa-plus-square"></i> ADICIONAR</a></h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class = "col-md-12">
                <form action="{{route('usuario.search')}}" method="post">
                    @csrf
                    <div class = "row">
                        <div class= "col-md-10">    
                            <input type="text" class="form-control" id="filtrar" value="{{$filtros['filtrar'] ?? ''}}" name="filtrar" placeholder = "pesquisar por"> 
                        </div>
                        <div class= "col-md-2">
                            <button type="submit" class= "btn btn-success btn-block" >Pesquisar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    {{-- @if ($usuarios->count() != 0) --}}
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Código</th>
                                    <th class="border-top-0" scope="col">Nome</th>
                                    <th class="border-top-0" scope="col">E-mail</th>
                                    <th class="border-top-0" scope="col">Perfil</th>
                                    <th class="border-top-0" scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <th scope="row">{{$usuario->id}}</th>
                                        <th scope="row">{{$usuario->name}}</th>
                                        <th scope="row">{{$usuario->email}}</th>
                                        <th scope="row">{{$usuario->perfil->nome}}</th>
                                        <th scope="row">{{$usuario->status->nome}}</th>
                                        <td style="width: 250px">
                                            <a href="{{route('usuario.edit', $usuario->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{route('usuario.show', $usuario->id)}}" class="btn btn-success">ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            @if (isset($filtros))
                                {!! $usuarios->links()!!}
                            @else
                                {!! $usuarios->links()!!}
                            @endif
                        </div>
                   {{--  @else
                        <h1>Ops ainda não foi cadastrado nenhum usuario</h1>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
    <script>
        $(document).ready(function($){
            $('.cpf_cnpj').mask('00.000.000/0000-00');
            $('.cep').mask("99999-999");
            //$('.ie').mask("999.99999-99");
            $('.telefone').mask('(99) 9999-9999'); 
            $('.celular').mask('(99) 99999-9999'); 
            
        }); 

    </script>
@endpush 

@extends('layouts.template')

@section('content')
@include('includes.alert')
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Produtos Cadastrados</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">produtos</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="float-right">
                        <a href="{{route('produto.create')}}" class="btn btn-primary">Cadastrar um novo produto</a>
                    </div>
                </div>

    <div class = "col-md-12">
            <form action="{{route('produto.search')}}" method="post">
                @csrf
                <div class = "row">
                    <div class= "col-md-10">    
                        <input type="text" class="form-control" id="filtrar" value="{{$filtros['filtrar'] ?? ''}}" name="filtrar" placeholder = "Pesquisar por"> 
                    </div>
                    <div class= "col-md-2">
                        <button type="submit" class= "btn btn-success btn-block" >Pesquisar</button>
                    </div>
                </div>
            </form>
    
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover display">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Produto</th>
                                    <th class="text-center">Código de Referência</th>
                                    <th class="text-center">Tipo do Produto</th>
                                    <th class="text-center">Categoria</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produtos as $produto)
                                <tr>
                                    <td class="text-center text-muted">#{{$produto->id}}</td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">{{$produto->nome}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center _codigo_referencia">{{$produto->codigo_referencia}}</td>
                                    <td class="text-center _tipo_produto">{{$produto->tipoProduto->descricao}}</td>
                                    <td class="text-center">
                                        {{$produto->categoria->nome}}
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-mouse-pointer"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item text-primary" href="{{route('produto.show', $produto->id)}}">Ver</a>
                                                <a class="dropdown-item text-success" href="{{route('produto.edit', $produto->id)}}">Editar</a>
                                                <a class="dropdown-item text-danger" href="{{route('produto.destroy',$produto->id)}}">Excluir</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            @if (isset($filtros))
                            {!! $produtos->appends($filtros)->links()!!}
                            @else
                                {!! $produtos->links()!!}
                            @endif
                        </div>
                    </div>
                </div>
            </div><!-- end card-->
        </div>
    </div>
</div>
@endsection
@extends('layouts.template')

@section('content')
@include('includes.alert')
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Perfil Cadastrados</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Perfil</li>
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
                        <a href="{{route('perfil.create')}}" class="btn btn-primary">Cadastrar um novo perfil</a>
                    </div>
                </div>

            <div class = "col-md-12">
                <form action="{{route('perfil.search')}}" method="post"> 
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
                    @if ($perfils->count() != 0)
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Descriçao</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($perfils as $perfil)
                                    <tr>
                                        <td>
                                            {{$perfil->nome}}
                                        </td>
                                        <td>
                                            {{$perfil->descricao}}
                                        </td>
                                        <td style="width: 250px">
                                            <a href="{{route('perfil.edit', $perfil->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{route('perfil.show',  $perfil->id)}}" class="btn btn-warning">Ver</a>
                                            {{-- <a href="{{route('perfil.permissao',  $perfil->id)}}" class="btn btn-secondary"><i class="fas fa-lock"></i></a>
                                            <a href="{{route('perfil.plano',  $perfil->id)}}" class="btn btn-success"><i class="fas fa-list-ul"></i></a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h1>Não existe perfil candastrado</h1>
                    @endif
                    <div class="card-footer">
                        @if (isset($filtros))
                            {!!$perfils->appends($filtros)->links()!!}
                        @else
                            {!!$perfils->links()!!}
                        @endif
                    </div>
                </div>
            </div><!-- end card-->
        </div>
    </div>
</div>
@endsection
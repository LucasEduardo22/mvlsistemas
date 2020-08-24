@extends('layouts.template')

@section('content')
@include('includes.alert')
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Fornecedores Cadastrados</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Fornecedores</li>
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
                        <a href="{{route('fornecedor.create')}}" class="btn btn-primary">Cadastrar um novo Fornecedor</a>
                    </div>
                </div>

    <div class = "col-md-12">
            {{-- <form action="{{route('fornecedor.search')}}" method="post"> --}}
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
                                    <th>Nome</th>
                                   <th class="text-center">Acão</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fornecedors as $fornecedor)
                                <tr>
                                    <td class="text-center text-muted">#{{$fornecedor->id}}</td>
                                    <td class="text-center _cnpj">{{$fornecedor->cnpj}}</td>
                                    <td class="text-center _telefone">{{$fornecedor->telefone}}</td>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            @if (isset($filtros))
                            {!! $fornecedors->appends($filtros)->links()!!}
                            @else
                                {!! $fornecedors->links()!!}
                            @endif
                        </div>
                    </div>
                </div>
            </div><!-- end card-->
        </div>
    </div>
</div>
@endsection
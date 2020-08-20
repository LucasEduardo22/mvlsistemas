@extends('layouts.template')

@section('content')
@include('includes.alert')
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Clientes Cadastrados</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Clientes</li>
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
                        <a href="{{route('cliente.create')}}" class="btn btn-primary">Cadastrar um novo cliente</a>
                    </div>
                </div>

    <div class = "col-md-12">
            <form action="{{route('cliente.search')}}" method="post">
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
    
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover display">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Empresa</th>
                                    <th class="text-center">CNPJ</th>
                                    <th class="text-center">Telefone</th>
                                    <th class="text-center">Cidade</th>
                                    <th class="text-center">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                <tr>
                                    <td class="text-center text-muted">#{{$cliente->id}}</td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    <a class="text-dark" href="{{route('cliente.edit', $cliente->id)}}">
                                                        <div class="widget-heading">{{$cliente->razao_social}}</div>
                                                        <div class="widget-subheading opacity-7">{{$cliente->nome_cliente}}
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center _cnpj">{{$cliente->cnpj}}</td>
                                    <td class="text-center _telefone">{{$cliente->telefone}}</td>
                                    <td class="text-center">{{$cliente->cidade}}</td>
                                    <td class="text-center">{{$cliente->estado}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            @if (isset($filtros))
                            {!! $clientes->appends($filtros)->links()!!}
                            @else
                                {!! $clientes->links()!!}
                            @endif
                        </div>
                    </div>
                </div>
            </div><!-- end card-->
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function($){
        $('._cnpj').mask('00.000.000/0000-00');
        $('._cep').mask("99999-999");
        $('._inscricao_estadual').mask("99999999-99");
        $('._telefone').mask('(99) 99999-9999'); 
         
    }); 
</script>
@endpush 
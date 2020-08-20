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
                                    <th class="text-center">Telefone</th>
                                    <th class="text-center">Função</th>
                                    <th class="text-center">Código</th>
                                    {{-- <th class="text-center">Estado</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fornecedors as $fornecedor)
                                <tr>
                                    <td class="text-center text-muted">#{{$fornecedor->id}}</td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    <a class="text-dark" href="{{route('fornecedor.edit', $fornecedor->id)}}">
                                                        <div class="widget-heading">{{$fornecedor->razao_social}}</div>
                                                        <div class="widget-subheading opacity-7">{{$fornecedor->nome_fornecedor}}
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    {{-- <td class="text-center _cnpj">{{$fornecedor->cnpj}}</td>
                                    <td class="text-center _telefone">{{$fornecedor->telefone}}</td>
                                    <td class="text-center">{{$fornecedor->cidade}}</td>
                                    <td class="text-center">{{$fornecedor->estado}}</td> --}}
                                </tr>
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
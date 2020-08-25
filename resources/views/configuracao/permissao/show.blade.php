@extends('layouts.template')

@section('content')
@include('includes.alert')
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Detalhes da Permissão {{$permissao->nome}}</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Permissão</li>
                    <li class="breadcrumb-item active"> {{$permissao->nome}}</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{$permissao->nome}}
                </li>
                <li>
                    <strong>Descrição:</strong> <br>{{$permissao->descricao}}
                </li>
            </ul>
            @include('includes.alert')
            <form action="{{route('permissao.destroy', $permissao->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Deleta o Permissao {{$permissao->nome}}</button>
            </form>
        </div>
    </div>
</div>

@endsection
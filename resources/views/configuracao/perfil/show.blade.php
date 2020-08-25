@extends('layouts.template')

@section('content')
@include('includes.alert')
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Detalhes do Perfil {{$perfil->nome}}</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Perfil</li>
                    <li class="breadcrumb-item active"> {{$perfil->nome}}</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{$perfil->nome}}
                </li>
                <li>
                    <strong>Descrição:</strong> <br>{{$perfil->descricao}}
                </li>
            </ul>
            @include('includes.alert')
            <form action="{{route('perfil.destroy', $perfil->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Deleta o Perfil {{$perfil->nome}}</button>
            </form>
        </div>
    </div>
</div>

@endsection
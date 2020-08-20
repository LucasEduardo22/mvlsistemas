@extends('layouts.template')

@section('content')
@include('includes.alert')
<div class="margin-top" >
    <div class="card" >
        <div class="card-header">
            <h2> Adicionar Ficha Técnica
                <div class="float-right">
                    <p>{{$produto->nome}}</p>
                    <p>{{$produto->codigo_referencia}}</p>
                </div>
            </h2>
        </div>
    <div class="card-body">
        <form action="{{route('produto.fichatecnica.store', $produto->id)}}" method="post">
            @method('POST')
            @include('produto.fichatecnica.form') 
        </form>
    </div>
    </div>
</div>
@endsection

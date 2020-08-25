@extends('layouts.template')

@section('content')
@include('includes.alert')
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Cadastrar uma nova Permissão</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Perifl</li>
                    <li class="breadcrumb-item active">Editar a permissão {{$permissao->nome}}</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <form action="{{route('permissao.update', $permissao->id)}}" method="post">
                @method('PUT')
                @include('configuracao.permissao.partials.form') 
            </form>
        </div>
    </div>
</div>
@endsection
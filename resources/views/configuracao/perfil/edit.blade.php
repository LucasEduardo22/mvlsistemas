@extends('layouts.template')

@section('content')
@include('includes.alert')
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Cadastrar uma nova Perfil</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Perfil</li>
                    <li class="breadcrumb-item active">Editar o perfil {{$perfil->nome}}</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <form action="{{route('perfil.update', $perfil->id)}}" method="post">
                @method('PUT')
                @include('configuracao.perfil.partials.form') 
            </form>
        </div>
    </div>
</div>
@endsection
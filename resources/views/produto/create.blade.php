@extends('layouts.template')

@section('content')
@include('includes.alert')

<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Cadastrar um novo produto</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Produto</li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="card" >
        <div class="card-header">
            <h2> 
                Adicionar um produto
            </h2>
        </div>
        <div class="card-body">
            @include('produto.partials.form') 
        </div>
    </div>
</div>

@endsection

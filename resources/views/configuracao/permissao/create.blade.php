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
                    <li class="breadcrumb-item active">Permissão</li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <form action="{{route('permissao.store')}}" method="post">
                @method('POST')
                @include('configuracao.permissao.partials.form') 
            </form>
        </div>
    </div>
</div>
@endsection
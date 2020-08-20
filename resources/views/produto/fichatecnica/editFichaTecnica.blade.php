@extends('layouts.template')

@section('content')
@include('includes.alert')
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Editar Ficha Técnica</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">produto</li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <form action="{{route('produto.fichatecnica.update', $produto->id)}}" method="post">
                @method('PUT')
                @include('produto.fichatecnica.form')
            </form>
        </div>
    </div>
</div>

@endsection

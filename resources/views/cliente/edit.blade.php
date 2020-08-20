@extends('layouts.template')

@section('content')
@include('includes.alert')
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Editar o cliente</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">cliente</li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card-body">
            @include('cliente.partials.form') 
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    $(document).ready(function($){
        $('#_cnpj').mask('00.000.000/0000-00');
        $('#_cep').mask("99999-999");
        $('#_inscricao_estadual').mask("999.99999-99");
        $('#_telefone').mask('(99) 99999-9999'); 
         
    }); 
</script>
@endpush 
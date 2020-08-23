@extends('layouts.template')

@section('content')
@include('includes.alert')
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Cadastrar um Fornecedor</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Fornecedor</li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <form action="{{route('fornecedor.store')}}" method="post">
                @method('POST')
                @include('fornecedor.partials.form') 
            </form>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    $(document).ready(function($){

        $('#_cnpj_cpf').mask('00.000.000/0000-00');
        $('#_cep').mask("99999-999");
        //$('#_cep').mask('00000-000');
        $('#_telefone').mask('(99) 99999-9999'); 

        $('#_cnpj').click(function() {
            $('#situacao').text("CNPJ");
            $('#_cnpj_cpf').mask('00.000.000/0000-00');
            $("#_cnpj_cpf").attr("placeholder", "99.999.999/0000-00").placeholder();
        });

        $('#_cpf').click(function() {
            $('#situacao').text("CPF"); 
            $("#_cnpj_cpf").mask("999.999.999-99");
            $("#_cnpj_cpf").attr("placeholder", "999.999.999-99").placeholder();
        });
        var campo = $('input[name="chklista":checked]').val();
            alert(campo);
   

        $(document).on('change','#_cep', function(e){
                //var cep = $("input[name=cep]").val();
                $.ajax({
                    type: 'post',
                    url: '{{ route("endereco.estado.search") }}',
                    dataType: 'json',
                    //async: false,
                    data: {cep: $('[name=cep]').val()},
                    //contentType: "application/json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        var $el = $('[name=estado]');
                        //var data = JSON.parse(JSON.stringify(data));
                        console.log(data.nome);
                        if (data != 0) {
                            $('[name=estado]').val(data.nome);
                        } else {
                            $('[name=estado]').val('Teste');
                        }
                        
                    }
                });
                $.ajax({
                    type: 'post',
                    url: '{{ route("endereco.cidade.search") }}',
                    dataType: 'json',
                    //async: false,
                    data: {cep: $('[name=cep]').val()},
                    //contentType: "application/json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        var $el = $('[name=cidade]');
                        //var data = JSON.parse(JSON.stringify(data));
                        //console.log(data.nome);
                        $('[name=cidade]').val(data.nome);
                    }
                });
                $.ajax({
                    type: 'post',
                    url: '{{ route("endereco.bairro.search") }}',
                    dataType: 'json',
                    //async: false,
                    data: {cep: $('[name=cep]').val()},
                    //contentType: "application/json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        var $el = $('[name=bairro]');
                        //var data = JSON.parse(JSON.stringify(data));
                        //console.log(data);
                        $('[name=bairro]').val(data.nome);
                    }
                });
                $.ajax({
                    type: 'post',
                    url: '{{ route("endereco.search") }}',
                    dataType: 'json',
                    //async: false,
                    data: {cep: $('[name=cep]').val()},
                    //contentType: "application/json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        var $el = $('[name=logradouro]');
                        //var data = JSON.parse(JSON.stringify(data));
                        //console.log(data.logadora);
                        $('[name=logradouro]').val(data.logradouro);
                    }
                });
            })  
    });
</script>
@endpush
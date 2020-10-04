@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Editar a empresa {{$empresa->nome}} @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <!-- page vendors -->
    <link href="{{ asset('css/pages.css') }}" rel="stylesheet">
    <!--end of page vendors -->
@stop
@section('content')
    @include('includes.alert')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('empresa.index') }}">empresas</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('empresa.edit', $empresa->id) }}">{{$empresa->nome_empresa}}</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="mt-2">Editar a empresa <strong>{{$empresa->nome_empresa}}</strong></h1>
        </section>
        <div class="separator-breadcrumb pb-5 border-top"></div>
        <div class="card-body">
            <div class="card-body">
                <form action="{{route('empresa.update', $empresa->id)}}" class="form-horizontal" method="post" enctype="multipart/form-data" class="form">
                    @method('PUT')
                    @csrf
                    @include('admin.empresa._partials.form')
                </form>
            </div>
        </div>
    </div>
@stop
@push('scripts')
    <script>
        $(document).ready(function($){
            $('#_cpf_cnpj').mask('00.000.000/0000-00');
            $('#_cep').mask("99999-999");
            //$('#_ie').mask("999.99999-99");
            $('#_telefone').mask('(99) 9999-9999'); 
            $('#_celular').mask('(99) 99999-9999'); 
            $(".text_maiusculo").on("input", function(){
                $(this).val($(this).val().toUpperCase());
            });
            $('.cpf-cnpj').change(function(){
                var campo = $(this).val();
                console.log(campo );
                if (campo == "cpf"){	
                   // $("#InputCpf-cnpj").val('');
                    $("#label-cpf_cnpj").html('CPF');
                    $("#_cpf_cnpj").attr("placeholder", "999.999.999-99");
                    $("#_cpf_cnpj").mask("999.999.999-99");
                }
                else if (campo == "cnpj"){
                // $("#InputCpf-cnpj").val('');
                    $("#label-cpf_cnpj").html('CNPJ');
                    $("#_cpf_cnpj").attr("placeholder", "99.999.999/9999-99");
                    $("#_cpf_cnpj").mask("99.999.999/9999-99");
                }			
            }); 

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
                        console.log(data.nome);
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
                        console.log(data);
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
                        var $el = $('[name=endereco]');
                        //var data = JSON.parse(JSON.stringify(data));
                        //console.log(data.logadora);
                        $('[name=endereco]').val(data.endereco);
                    }
                });
            });

            $('#_image').change(function(){
                const file = $(this)[0].files[0];
                const fileReader = new FileReader();

                fileReader.onloadend = function(){
                    $("#_logo").attr('src', fileReader.result);
                    console.log(fileReader.result)
                }
                fileReader.readAsDataURL(file)
                
            });
        }); 

    </script>
@endpush 

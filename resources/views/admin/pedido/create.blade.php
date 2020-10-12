@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Pedidos @parent
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
            <a href="{{ route('pedido.create') }}">Pedido</a>
        </li>
    </ol>
    <div class="card">
        <div class="card-body">
            <div class="col-md-12">
                <div class="card-group linha-horizontal">
                    <div class="card">
                        <div class="card-body linha-vertical">
                            <h5 class="card-title text-center">CRIAR PEDIDO</h5>
                            <div class="separator-breadcrumb pt-1 pb-2 border-dark border-top"></div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4 pb-0">Tipo Pedido:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Venda
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        <label class="form-check-label" for="exampleRadios2">
                                            Orçamento
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Forma de pagamento:</label>
                                    <select id="_forma_pagamento" name="forma_pagamento" class="form-control @error('forma_pagamento') is-invalid @enderror">
                                        <option>Selecione</option>
                                        @foreach ($formaPagamentos as $formaPagamento)
                                            <option value="{{$formaPagamento->id}}" @if(old('forma_pagamento_id', !empty($formaPagamento->id) ? $formaPagamento->id : '' ) == $formaPagamento->id ) selected="" @endif>{{$formaPagamento->nome}}</option>
                                        @endforeach
                                    </select>
                                    @error('forma_pagamento_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputPassword4 pb-0">Desconto:</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <p>Cliente: <strong class="text-success" id="_status">Pendente</strong></p>
                                </div>
                                <div class="form-group col-md-4">
                                    <p>Preço total: <strong class="text-dark" id="_status">R$ 120,00</strong></p>
                                </div>
                                <div class="form-group col-md-4 pr-2">
                                    <p>Quantidade total: <strong class="text-dark" id="_status">10 peças</strong></p>
                                </div>
                            </div>
                            <div class="row float-right">
                                <div class="col-md-5 d-flex justify-content-start mr-0">
                                    <label for="_modelo" class="pb-0 pr-2 mb-0">Modelo:</label>
                                    <input type="text" name="filtrar_modelo" class="form-control pt-0" id="_modelo" value="{{old("modelo")}}">
                                </div>
                                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modalProduto">ADICIONAR PRODUTO</button>
                                @include('admin.pedido.modal.produto')
                            </div>
                        </div>
                    </div>
                    <div class="card col-sm-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="row">
                                    <div class= "col-md-10"> 
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-success" id="search"><i class="fas fa-search"></i></div>
                                            </div>
                                            <input type="text" class="form-control" id="filtrar" name="filtrar" placeholder = "codigo ou CNPJ"> 
                                        </div>     
                                    </div>
                                </div>
                                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modalCliente"><i class="fas fa-plus-square"></i> ADD</button>
                                @include('admin.pedido.modal.cliente')
                            </div>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="client_id">
                            <ul class="list-unstyled">
                                <li>Cliente: <strong id="nome"></strong></li>
                                <li>CNPJ: <strong id="_cpf_cnpj"></strong></li>
                                <li>Telefone: <strong id="_telefone"></strong></li>
                                <li>Celular: <strong class=""  id="_celular"></strong></li>
                                <li>Cidade: <strong  id="cidade"></strong></li>
                                <li>Estado: <strong id="estado"></strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body linha-verticalEstoque">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="border-top-0" scope="col">#</th>
                                        <th class="border-top-0" scope="col">Produto</th>
                                        <th class="border-top-0" scope="col">Sub Grup</th>
                                        <th class="border-top-0" scope="col">Quantidade</th>
                                        <th class="border-top-0" scope="col">Valor</th>
                                        <th class="border-top-0" scope="col">Ação</th>
                                    </tr>
                                </thead>
                                <tbody class="_adicionarProduto">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
    <script>
        $(document).ready(function($) {
            $('.cpf_cnpj').mask('00.000.000/0000-00');
            $('.cep').mask("99999-999");
            //$('.ie').mask("999.99999-99");
            $('.telefone').mask('(99) 9999-9999');
            $('.celular').mask('(99) 99999-9999');
            $('.sem_tamanho').hide();

            $('input[type=radio]').change(function() {
                $('input[type=radio]:checked').not(this).prop('checked', false);
            });

            $('.tipos').change(function(){
                var campo = $(this).val();
                console.log(campo );
                if (campo == "T"){	
                    $('.femin').show();
                    $('.masc').show();
                    $('.sem_tamanho').hide();
                }
                else if (campo == "M"){
                    $('.tem_tamanho').show();
                    $('.femin').hide();
                    $('.sem_tamanho').hide();
                    $('.masc').show();
                }			
                else if (campo == "F"){
                    $('.tem_tamanho').show();
                    $('.femin').show();
                    $('.sem_tamanho').hide();
                    $('.masc').hide();
                }else{
                    $('.tem_tamanho').hide();
                    $('.sem_tamanho').show();
                }			
            });
            $(document).on('click', '._selecionar', function(e) {
                e.preventDefault;

                var id = $(this).closest('tr').find('td[data-id]').data('id');

                $.ajax({
                    type: 'post',
                    url: '{{ route("pedido.cliente.searchPedido") }}',
                    dataType: 'json',
                    //async: false,
                    data: {filtrar: $(this).closest('tr').find('td[data-id]').data('id')},
                    
                    //contentType: "application/json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        //var $el = $('[name=estado]');
                        var data = JSON.parse(JSON.stringify(data));
                        var cnpj = data.cpf_cnpj
                        console.log(data);
                       if (data != 0) {
                            $('#modalCliente').modal('hide')
                            $('#nome').html(data.nome);
                            $('#_cpf_cnpj').text(data.cpf_cnpj).mask('00.000.000/0000-00');
                            $('#_telefone').html(data.telefone).mask('(99) 9999-9999');
                            $('#_celular').html(data.celular).mask('(99) 99999-9999');
                            $('#cidade').html(data.cidade);
                            $('#estado').html(data.estado);
                        } else {
                            alert("dados não encontrado");
                        }  
                        
                    }
                });
            });
            $(document).on('click', '#search', function(e) {
                e.preventDefault;
                $.ajax({
                    type: 'post',
                    url: '{{ route("pedido.cliente.searchPedido") }}',
                    dataType: 'json',
                    //async: false,
                    data: {filtrar: $('[name=filtrar]').val()},
                    //contentType: "application/json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        //var $el = $('[name=estado]');
                        var data = JSON.parse(JSON.stringify(data));
                        var cnpj = data.cpf_cnpj
                        console.log(data);
                        if (data != 0) {
                            $('#modalCliente').modal('hide')
                            $('#nome').html(data.nome);
                            $('#_cpf_cnpj').text(data.cpf_cnpj).mask('00.000.000/0000-00');
                            $('#_telefone').html(data.telefone).mask('(99) 9999-9999');
                            $('#_celular').html(data.celular).mask('(99) 99999-9999');
                            $('#cidade').html(data.cidade);
                            $('#estado').html(data.estado);
                        } else {
                            alert("dados não encontrado");
                        }  
                        
                    }
                }); 
            }); 
            $(document).on('change', '#_modelo', function(e){
                e.preventDefault;
                //var id = $('[name=filtrar_modelo]').val();
                //console.log(id);

                $.ajax({
                    type: 'post',
                    url: '{{ route("pedido.produto") }}',
                    dataType: 'json',
                    //async: false,
                    data: {filtrar: $('[name=filtrar_modelo]').val()},
                    //contentType: "application/json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        //var $el = $('[name=estado]');
                        var data = JSON.parse(JSON.stringify(data));
                        var cnpj = data.cpf_cnpj
                        //console.log(data[2]);
                        if (data != 0) {
                            $('._adicionarProduto').html(
                                "<tr>"+
                                    "<td>"+data[0].modelo+"</td>"+
                                    "<td>"+data[0].nome_produto+"</td>"+
                                    "<td>"+data[1]+"</td>"+
                                    "<td>0</td>"+
                                    "<td>R$0,00</td>"+
                                    '<td><a href="" class="btn btn-primary">'+
                                        'detalhes'+
                                    '</a></td>'+
                                "<tr>"
                            );
                            
                            $('.grupo').html();
                        } else {
                            alert("dados não encontrado");
                        }  
                        
                    }
                }); 
            });
        });

    </script>
@endpush

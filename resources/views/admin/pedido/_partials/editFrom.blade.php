<div class="card">
    <div class="card-body">
        <div class="col-md-12">
            <div class="card-group linha-horizontal">
                <div class="card">
                    <div class="card-body linha-vertical">
                        <p class="float-right">Vendedor: {{ Auth::user()->name }}</p>
                        <h5 class="card-title text-center">CRIAR PEDIDO</h5>
                        <div class="separator-breadcrumb pt-1 pb-2 border-dark border-top"></div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputPassword4 pb-0">Tipo Pedido:</label>
                                <input type="hidden" name="tipo_pedido_id" value="V">
                                <div class="form-check">
                                    <input class="form-check-input tipo_pedido" type="radio" name="_tipo_pedido_id" id="_tipo_pedido1" value="V" checked>
                                    <label class="form-check-label" for="_tipo_pedido1">
                                        Venda
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input tipo_pedido" type="radio" name="_tipo_pedido_id" id="_tipo_pedido2" value="O">
                                    <label class="form-check-label" for="_tipo_pedido2">
                                        Orçamento
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Forma de pagamento:</label>
                                <select id="_forma_pagamento" name="forma_pagamento" class="form-control forma_pagamento @error('forma_pagamento') is-invalid @enderror">
                                    <option value="0">Selecione</option>
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
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p>Situção: <strong class="text-success" id="_status">Pendente</strong></p>
                            </div>
                            <div class="form-group col-md-4">
                                <p>Preço total: <strong class="text-dark" id="_valor_itens"></strong></p>
                            </div>
                            <div class="form-group col-md-4 pr-2">
                                <p>Quantidade total: <strong class="text-dark" id="_qtd_itens"></strong></p>
                            </div>
                            <div class="form-group col-md-4 pr-2">
                                <input type="hidden" name="codigo" value="{{$pedido->cliente->id}}">
                                <p>Pedido: <strong class="text-dark" id="_codigo">{{$pedido->id}}</strong></p>
                            </div>
                        </div>
                         <div class="alert alert-danger d-none messageBox" role="alert">
                             
                         </div>  
                        <div class="row float-right">
                            <div class="col-md-5 d-flex justify-content-start mr-0">

                                <label for="_modelo" class="pb-0 pr-2 mb-0">Modelo:</label>
                                <div class="input-group-prepend">
                                    <div class="input-group-text text-white bg-secondary" id="search_modelo"><i class="fas fa-search"></i></div>
                                </div>
                                <input type="text" name="filtrar_modelo" class="form-control" id="_modelo" value="{{old("modelo")}}">
                            </div>
                            <a class="btn btn-primary float-right text-light" data-toggle="modal" data-target="#modallistaProduto">ADICIONAR PRODUTO</a>
                            @include('admin.pedido.modal.listaProduto')
                        </div>
                    </div>
                </div>
                <div class="card col-sm-4">
                    <div class="card-header">
                        <div class="row">
                            <div class="row">
                                <div class= "col-md-8"> 
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-success" id="search"><i class="fas fa-search"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="filtrar" name="filtrar_cliente" placeholder = "Código ou CNPJ"> 
                                    </div>     
                                </div>
                                <div class="pl-0"> 
                                    <a class="btn btn-primary text-light" data-toggle="modal" data-target="#modalCliente"><i class="fas fa-plus-square"></i> ADICIONAR</a>    
                                </div>
                            </div>
                            @include('admin.pedido.modal.cliente')
                        </div>
                    </div>
                    <div class="card-body">
                        <input type="hidden" value="{{$pedido->cliente->id}}" name="cliente_id">
                        <ul class="list-unstyled">
                            <li>Cliente: <strong id="nome">{{$pedido->cliente->nome}}</strong></li>
                            <li>CNPJ: <strong id="_cpf_cnpj">{{$pedido->cliente->cpf_cnpj}}</strong></li>
                            <li>Telefone: <strong id="_telefone">{{$pedido->cliente->telefone}}</strong></li>
                            <li>Celular: <strong class=""  id="_celular">{{$pedido->cliente->celular}}</strong></li>
                            <li>Cidade: <strong  id="cidade">{{$pedido->cliente->cidade}}</strong></li>
                            <li>Estado: <strong id="estado">{{$pedido->cliente->estado}}</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card" id="#loader" style="height: 480px;">
                <div class="card-body linha-verticalEstoque" style="height: 430px;">
                    <div class="table-overflow " style="height: 430px;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Código</th>
                                    <th class="border-top-0" scope="col">Produto</th>
                                    <th class="border-top-0" scope="col">Sub Grup</th>
                                    <th class="border-top-0" scope="col">Quantidade</th>
                                    <th class="border-top-0" scope="col">Valor</th>
                                    <th class="border-top-0" scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody class="_adicionarProduto">
                                @foreach ($pedido->itensPedido as $itensPedido)
                                    <tr>
                                        <td data-modelo='{{$itensPedido->estoque->produto->modelo}}' scope="row">{{$itensPedido->estoque->produto->modelo}}</td>
                                        <td data-nome_produto='{{$itensPedido->estoque->produto->nome_produto}}'>{{$itensPedido->estoque->produto->nome_produto}}</th>
                                        <td data-subgrupo='{{$itensPedido->estoque->produto->subGrupo->nome}}'>{{$itensPedido->estoque->produto->subGrupo->nome}}</td>
                                        <td>{{$itensPedido->quantidade($itensPedido->id)}}</td>
                                        <td>{{'R$ '.number_format($itensPedido->valor($itensPedido->id), 2, ',', '.')}}</td>
                                        <td style="width: 250px">
                                            <button href="" class="btn btn-primary text-light detalhes" data-toggle="modal" >detalhes</button> 
                                            <input type="hidden"  class="valor_produto" name="valor_total{{$itensPedido->estoque->produto->modelo}}" value="{{$itensPedido->valor($itensPedido->id)}}"> 
                                            <input type="hidden" class="qtd_produto" name="qtd_total{{$itensPedido->estoque->produto->modelo}}" value="{{$itensPedido->quantidade($itensPedido->id)}}">
                                            <button href="" class="ml-1 btn btn-danger text-light remover"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2 mb-2">
                        <button class="btn btn-primary float-right" name="status_id" value="2">FINALIZAR</button> 
                        <button class="btn btn-success mr-2 float-right" name="status_id" value="1">SALVAR</button> 
                        <button class="btn btn-danger mr-2 float-right" name="status_id" value="0">CANCELAR</button> 
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    @include('admin.pedido.modal.editProduto')
    <div class="modal" tabindex="-1" role="dialog" id="loading"></div>
    <div id="itens">
        @foreach ($pedido->itensPedido as $itensPedido)
            <input name="tokenProduto[]" value="{{$itensPedido->id}}" class="produto_item" type="hidden" id="produto_id{{$itensPedido->estoque->produto->modelo}}"/>
        @endforeach
    </div>
</div>
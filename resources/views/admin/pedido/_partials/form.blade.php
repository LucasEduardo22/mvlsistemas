
<div class="row my-2 border-bottom-0">
    <div class="col-sm-12 col-md-8 linha-vertical">
        <p class="float-right">Vendedor: {{ Auth::user()->name }}</p>
        <h5 class="card-title text-center">CRIAR PEDIDO</h5>
        <div class="separator-breadcrumb pt-1 pb-2 border-dark border-top"></div>
        <div class="form-row">
            <div class="form-group col-md-3">
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
            <div class="form-group col-md-3">
                <label for="inputEmail4">Tabela de preço:</label>
                <select id="_tabela_preco_id" name="tabela_preco_id" class="form-control @error('tabela_preco_id') is-invalid @enderror" required>
                    <option value="0">Selecione</option>
                    @foreach ($tabelaPrecos as $tabelaPreco)
                        <option value="{{$tabelaPreco->id}}" @if(old('tabela_preco_id', !empty($pedido->tabelaPreco->id) ? $pedido->tabelaPreco->id : '') == $tabelaPreco->id ) selected="" @endif>{{$tabelaPreco->nome}}</option>
                    @endforeach
                </select>
                <input type="hidden" name="" id="ganho" value="0">
                @error('tabela_preco_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label for="inputEmail4">Forma de pagamento:</label>
                <select id="_forma_pagamento_id" name="forma_pagamento_id" class="form-control forma_pagamento @error('forma_pagamento_id') is-invalid @enderror" required>
                    <option value="0">Selecione</option>
                    @foreach ($formaPagamentos as $formaPagamento)
                        <option value="{{$formaPagamento->id}}" @if(old('forma_pagamento_id', !empty($pedido->formaPagamento->id) ? $pedido->formaPagamento->id : '') == $formaPagamento->id ) selected="" @endif>{{$formaPagamento->nome}}</option>
                    @endforeach
                </select>
                @error('forma_pagamento_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label for="condicao pb-0">Condições:</label>
                <input type="text" name="condicao" class="form-control" id="formGroupExampleInput" placeholder="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <p>Situção: <strong class="text-success" id="_status">Pendente</strong></p>
            </div>
            <div class="form-group col-md-4">
                <p>Preço total: <strong class="text-dark" id="_valor_itens"  ></strong></p>
            </div>
            <div class="form-group col-md-4 pr-2">
                <p>Quantidade total: <strong class="text-dark" id="_qtd_itens"></strong></p>
            </div>
            <div class="form-group col-md-4 pr-2">
                <input type="hidden" name="codigo" value="">
                <p>Pedido: <strong class="text-dark" id="_codigo"></strong></p>
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
    <div class="col-sm-12 col-md-4">
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
                        <a class="btn btn-primary text-light" data-toggle="modal" data-target="#modalCliente"><i class="fas fa-plus-square"></i> ADD</a>    
                    </div>
                </div> 
                @include('admin.pedido.modal.cliente')
            </div>
        </div>
        <div class="card-body">
            <input type="hidden" name="cliente_id">
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
    <div class="col-sm-12 col-md-12">
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
                </tbody>
            </table>
        </div>
        <div class="mt-2 mb-2">
            <button class="btn btn-primary float-right" id="ordem" name="status_id" value="2">ORDEM PRODUÇÃO</button> 
            <button class="btn btn-success mr-2 float-right" name="status_id" value="1">SALVAR</button> 
            <button class="btn btn-danger mr-2 float-right" name="status_id" value="0">CANCELAR</button> 
        </div>
    </div>
    @include('admin.pedido.modal.produto')
    <div class="modal" tabindex="-1" role="dialog" id="loading"></div>
    <div id="itens"></div>
</div>

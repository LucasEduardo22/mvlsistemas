<div class="form-body">
    <h3>Dados do Produto</h3>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Código modelo:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$produto->modelo}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Produto:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$produto->nome_produto}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Tipo de produto:</label>
                    <div class="col-sm-8">
                        {{-- <p class="form-control-static"><strong>{{$produto->tipoProduto->nome}}</strong></p> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">SubGrupo:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$produto->subGrupo->nome}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Descrição:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{!$produto->descricao ? "Não informado": $produto->descricao}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <h3>Movimenta estoque</h3>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-3 control-label">Valor de Venda:</label>
                    <div class="col-sm-6">
                        <input value="{{old('preco_venda', !empty($estoque->preco_venda) ? number_format( $estoque->preco_venda , 2, ',', '.') : '')}}" type="text" name="preco_venda" placeholder="" class="form-control dinheiro @error('preco_venda') is-invalid @enderror" id="_preco_venda" />
                        @error('preco_venda')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-3 control-label">Estoque minimo:</label>
                    <div class="col-sm-6">
                        <input value="{{old('estoque_minimo', !empty($estoque->estoque_minimo) ? $estoque->estoque_minimo : '')}}" type="text" name="estoque_minimo" placeholder="" class="form-control @error('estoque_minimo') is-invalid @enderror" id="_estoque_minimo" />
                        @error('estoque_minimo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-3 control-label">Valor de Custo:</label>
                    <div class="col-sm-6">
                        <input value="{{old('custo_atual', !empty($estoque->custo_atual) ? number_format($estoque->custo_atual , 2, ',', '.') : '')}}" type="text" name="custo_atual" placeholder="" class="form-control dinheiro @error('custo_atual') is-invalid @enderror" id="_custo_atual" />
                        @error('custo_atual')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        {{-- 
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-3 control-label">Cor:</label>
                    <div class="col-sm-6">
                        <input value="{{old('cor', !empty($estoque->cor) ? $estoque->cor : '')}}" type="text" name="cor" placeholder="" class="form-control @error('cor') is-invalid @enderror" id="_cor" />
                        @error('cor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div> 
        </div>
        --}}
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label for="_tamanhoProduto" class="col-sm-3 control-label">Unidade:</label>
                    <div class="col-sm-6">
                        <select id="_unidade_id" name="unidade_id" class="form-control @error('unidade_id') is-invalid @enderror">
                            <option>--Select--</option>
                            @foreach ($unidades as $unidade)
                                <option value="{{$unidade->id}}" @if(old('modelo', !empty($estoque->unidade->id) ? $estoque->unidade->id : '' ) == $unidade->id ) selected="" @endif>{{ $unidade->sigla.' - '.$unidade->nome}}</option>
                            @endforeach
                        </select>
                        @error('unidade_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="separator-breadcrumb pb-2 border-dark border-top"></div>
    <h3>
        <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <i class="fas fa-plus-square"></i> Adicionar Tamanho
        </button>
    </h3>
    <div class="collapse" id="collapseExample">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <div class="container">
                        <div class="row">
                        @if (empty($produto->estoque->tamanho))
                            @foreach ($tamanhos as $tamanho)
                                <div class="col-3 order-last">
                                    <input type="hidden" name="tamanho[]" value="{{$tamanho->id}}">
                                    <p class="text_grid">{{$tamanho->id}}º
                                        {{$tamanho->sigla}}
                                    </p>
                                   <div class="form-group">
                                        <label for="_preco_venda1[]">Valor de venda:</label>
                                        <input type="text" name="preco_venda1[]" class="form-control dinheiro @error('preco_venda1[]') is-invalid @enderror" value="{{old("preco_venda1[]")}}" id="_preco_venda1[]" placeholder="R$ 000,00">
                                        @error('preco_venda1[]')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                     {{-- <div class="form-group">
                                        <label for="_preco_custo[]">Valor de custo:</label>
                                        <input type="text" name="preco_custo[]" class="form-control dinheiro @error('preco_custo[]') is-invalid @enderror" value="{{old("preco_custo[])")}}" id="_preco_custo" placeholder="R$ 000,00">
                                        @error('preco_custo[]')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="_quantidade[]">Quantidade:</label>
                                        <input type="text" name="quantidade[]" class="form-control dinheiro @error('quantidade[]') is-invalid @enderror" value="{{old("quantidade[]")}}" id="_quantidade" placeholder="">
                                        @error('quantidade[]')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}
                                </div>
                            @endforeach
                        @else
                            @foreach ($estoque->tamanho as $tamanhoProduto) 
                                <div class="col-3 order-last">
                                    <input type="hidden" name="tamanho[]" value="{{$tamanhoProduto->tamanho_id}}">
                                    <p class="text_grid">{{$tamanhoProduto->tamanhoProdutos->id}}º
                                        {{$tamanhoProduto->tamanhoProdutos->sigla}}
                                    </p>
                                    <div class="form-group">
                                        <label for="_preco_venda1[]">Valor de venda:</label>
                                        <input type="text" name="preco_venda1[]" class="form-control dinheiro @error('preco_venda1[]') is-invalid @enderror" value="{{old("preco_venda1[]", !empty($tamanhoProduto->preco_venda) ? number_format($tamanhoProduto->preco_venda, 2, ',', '.') : '')}}" id="_preco_venda1[]" placeholder="R$ 000,00">
                                        @error('preco_venda1[]')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    {{-- 
                                    <div class="form-group">
                                        <label for="_preco_custo[]">Valor de custo:</label>
                                        <input type="text" name="preco_custo[]" class="form-control dinheiro @error('preco_custo[]') is-invalid @enderror" value="{{old("preco_custo[])", !empty($tamanhoProduto->preco_custo) ? number_format($tamanhoProduto->preco_custo, 2, ',', '.'): '')}}" id="_preco_custo" placeholder="R$ 000,00">
                                        @error('preco_custo[]')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="_quantidade[]">Quantidade:</label>
                                        <input type="text" name="quantidade[]" class="form-control dinheiro @error('quantidade[]') is-invalid @enderror" value="{{old("quantidade[]", !empty($tamanhoProduto->quantidade) ? $tamanhoProduto->quantidade : '')}}" id="_quantidade" placeholder="">
                                        @error('quantidade[]')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}
                                </div>
                            @endforeach
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<button type="submit" name="botao" value="1" class="float-right btn btn-info col-2">Adicionar estoque</button>
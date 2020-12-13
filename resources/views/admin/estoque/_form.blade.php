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
        <div class="col-md-6 float-right">
            <div class="form-group">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <div class="form-check">
                            <input class="form-check-input metro_kilo" type="radio" name="metro_kilo" id="gridRadios2" @if(old('metro_kilo', !empty($estoque->metro_kilo) ? $estoque->metro_kilo : '' ) == "M" ) checked="" @endif value="M" >
                            
                            <label class="form-check-label metro_kilo" for="gridRadios2">
                                Metro M
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-check">
                            <input class="form-check-input metro_kilo" type="radio" name="metro_kilo" id="gridRadios1"
                            @if(old('metro_kilo', !empty($estoque->metro_kilo) ? $estoque->metro_kilo : '' ) == "P" ) checked="" @endif value="P">
                            <label class="form-check-label" for="gridRadios1">
                                Peso Kg
                            </label>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div> 
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-3 control-label">Tecido Principal:</label>
                    <div class="col-sm-6">
                        <input value="{{old('valor_tecido_principal', !empty($estoque->valor_tecido_principal) ?  $estoque->mask($estoque->id) : '')}}" type="text" name="valor_tecido_principal" placeholder="" class="form-control metro_kilo @error('valor_tecido_principal') is-invalid @enderror" id="_valor_tecido_principal" />
                        @error('valor_tecido_principal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
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
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-3 control-label">Tecido Secundario:</label>
                    <div class="col-sm-6">
                        <input value="{{old('valor_tecido_secundario', !empty($estoque->valor_tecido_secundario) ? $estoque->mask($estoque->id) : '')}}" type="text" name="valor_tecido_secundario" placeholder="" class="form-control @error('valor_tecido_secundario') is-invalid @enderror" id="_valor_tecido_secundario" />
                        @error('valor_tecido_secundario')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div> 
        </div>
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
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-3 control-label">Tecido Teciario:</label>
                    <div class="col-sm-6">
                        <input value="{{old('valor_tecido_terciario', !empty($estoque->valor_tecido_terciario) ?  $estoque->mask($estoque->id) : '')}}" type="text" name="valor_tecido_terciario" placeholder="" class="form-control @error('valor_tecido_terciario') is-invalid @enderror" id="_valor_tecido_terciario" />
                        @error('valor_tecido_terciario')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div> 
        </div>
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
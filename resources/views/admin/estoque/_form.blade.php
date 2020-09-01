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
                        <p class="form-control-static"><strong>{{$produto->tipoProduto->nome}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Categoria:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$produto->categoria->nome}}</strong></p>
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
                    <label for="_tamanho_id" class="col-sm-3 control-label">Tamanho:</label>
                    <div class="col-sm-6">
                        <select id="_tamanho_id" name="tamanho_id" class="form-control @error('tamanho_id') is-invalid @enderror">
                            <option>--Select--</option>
                            @foreach ($tamanhos as $tamanho)
                                <option value="{{$tamanho->id}}" @if(old('modelo', !empty($estoque->tamanho->id) ? $estoque->tamanho->id : '' ) == $tamanho->id ) selected="" @endif>{{ $tamanho->sigla.' - '.$tamanho->nome}}</option>
                            @endforeach
                        </select>
                        @error('tamanho_id')
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
                    <label class="col-sm-3 control-label">Estoque inicial:</label>
                    <div class="col-sm-6">
                        <input value="{{old('estoque_inicial', !empty($estoque->estoque_inicial) ? $estoque->estoque_inicial : '')}}" type="text" name="estoque_inicial" placeholder="" class="form-control @error('estoque_inicial') is-invalid @enderror" id="_estoque_inicial" />
                        @error('estoque_inicial')
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
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-3 control-label">Valor de Venda:</label>
                    <div class="col-sm-6">
                        <input value="{{old('preco_venda', !empty($estoque->preco_venda) ? $estoque->preco_venda : '')}}" type="text" name="preco_venda" placeholder="" class="form-control @error('preco_venda') is-invalid @enderror" id="_preco_venda" />
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
                    <label class="col-sm-3 control-label">Valor de Campra:</label>
                    <div class="col-sm-6">
                        <input value="{{old('preco_compra', !empty($estoque->preco_compra) ? $estoque->preco_compra : '')}}" type="text" name="preco_compra" placeholder="" class="form-control @error('preco_compra') is-invalid @enderror" id="_preco_compra" />
                        @error('preco_compra')
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
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label for="_tamanho_id" class="col-sm-3 control-label">Unidade:</label>
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
</div>
<button type="submit" name="botao" value="1" class="float-right btn btn-info col-2">Adicionar estoque</button>
<div class="form-row mt-0 mb-3">
    <div class="form-group col-md-4 ">
        <label for="_materia_prima_id">Tipo</label>
        <div class="input-group">
            <span class="input-group-append">
                <span class="input-group-text">
                    <i class="fas fa-clipboard-check"></i>
                </span>
            </span>
            <select id="_materia_prima_id" name="materia_prima_id" class="form-control tipo_produto @error('materia_prima_id') is-invalid @enderror">
                <option>--Select--</option>
                @foreach ($tipoProdutos as $tipoProduto)
                    <option value="{{$tipoProduto->id}}" @if(old('materia_prima_id', !empty($materiaPrima->tipoProduto->id) ? $materiaPrima->tipoProduto->id : '' ) == $tipoProduto->id ) selected="" @endif>{{$tipoProduto->nome}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label for="_nome">Produto</label>
        <div class="input-group">
            <span class="input-group-append">
                <span class="input-group-text">
                    <i class="fab fa-product-hunt"></i>
                </span>
            </span>
            <input value="{{old('nome', !empty($materiaPrima->nome) ? $materiaPrima->nome : '')}}" type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" placeholder="Nome da matéria prima" id="_nome">
            @error('nome')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="form-group col-md-3">
        <label for="_unidade_id">Unidade</label>
        <div class="input-group">
            <span class="input-group-append">
                <span class="input-group-text">
                    <i class="fas fa-weight-hanging"></i>
                </span>
            </span>
            <select id="_unidade_id" name="unidade_id" class="form-control @error('unidade_id') is-invalid @enderror">
                <option>--Select--</option>
                @foreach ($unidades as $unidade)
                    <option value="{{$unidade->id}}" @if(old('unidade_id', !empty($materiaPrima->unidade->id) ? $materiaPrima->unidade->id : '' ) == $unidade->id ) selected="" @endif>{{$unidade->sigla}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="form-row mb-3">
    <div class="form-group col-md-3">
        <label for="_estoque_inicial">Quantidade Inicial</label>
        <div class="input-group">
            <span class="input-group-append">
                <span class="input-group-text">
                    <i class="fas fa-boxes"></i>
                </span>
            </span>
            <input type="text" class="form-control @error('estoque_inicial') is-invalid @enderror" name="estoque_inicial" id="_estoque_inicial" value="{{old('estoque_inicial', !empty($materiaPrima->estoque_inicial) ? $materiaPrima->estoque_inicial : '' )}}">
            @error('estoque_inicial')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="form-group col-md-3">
        <label for="_estoque_minimo">Estoque mínimo</label>
        <div class="input-group">
            <span class="input-group-append">
                <span class="input-group-text">
                    <i class="fas fa-boxes"></i>
                </span>
            </span>
            <input type="text" class="form-control @error('estoque_minimo') is-invalid @enderror" name="estoque_minimo" id="_estoque_minimo" value="{{old('estoque_minimo', !empty($materiaPrima->estoque_minimo) ? $materiaPrima->estoque_minimo : '' )}}">
            @error('estoque_minimo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="form-group col-md-3">
        <label for="_preco_compra">Valor Compra</label>
        <div class="input-group">
            <span class="input-group-append">
                <span class="input-group-text">
                    <i class="fas fa-money-bill-wave"></i>
                </span>
            </span>
            <input type="text" class="form-control dinheiro @error('preco_compra') is-invalid @enderror" name="preco_compra" id="_preco_compra" value="{{old('preco_compra', !empty($materiaPrima->preco_compra) ? $materiaPrima->preco_compra : '' )}}">
            @error('preco_compra')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="form-group col-md-3">
        <label for="_marge_venda">Marge Venda</label>
        <div class="input-group">
            <span class="input-group-append">
                <span class="input-group-text">
                    <i class="fas fa-percentage"></i>
                </span>
            </span>
            
            <input type="number" step="0.01" class="form-control @error('marge_venda') is-invalid @enderror" name="marge_venda" id="_marge_venda" value="{{old('marge_venda', !empty($materiaPrima->marge_venda) ? $materiaPrima->marge_venda : '' )}}">
            @error('marge_venda')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>
<div class="form-row mb-3">
    <div class="form-group col-md-3">
        <label for="_sigla">Sigla</label>
        <div class="input-group">
            <span class="input-group-append">
                <span class="input-group-text">
                    <i class="fas fa-boxes"></i>
                </span>
            </span>
            <input type="text" class="form-control @error('sigla') is-invalid @enderror" name="sigla" id="_sigla" value="{{old('sigla', !empty($materiaPrima->sigla) ? $materiaPrima->sigla : '' )}}">
            @error('sigla')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="form-group col-md-3 tecidos">
        <label for="_composicao">Composição</label>
        <div class="input-group">
            <span class="input-group-append">
                <span class="input-group-text">
                    <i class="fas fa-boxes"></i>
                </span>
            </span>
            <input type="text" class="form-control @error('composicao') is-invalid @enderror" name="composicao" id="_composicao" value="{{old('composicao', !empty($materiaPrima->composicao) ? $materiaPrima->composicao : '' )}}">
            @error('composicao')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="form-group col-md-3 tecidos">
        <label for="_preco_compra">Cor do Tecido</label>
        <div class="input-group">
            <span class="input-group-append">
                <span class="input-group-text">
                    <i class="fas fa-fill-drip"></i>
                </span>
            </span>
            <select id="_core_id" name="core_id" class="form-control @error('core_id') is-invalid @enderror">
                <option>--Select--</option>
                @foreach ($cores as $cor)
                    <option value="{{$cor->id}}" @if(old('core_id', !empty($materiaPrima->cor->id) ? $materiaPrima->cor->id : '' ) == $cor->id ) selected="" @endif>{{$cor->nome}}</option>
                @endforeach
            </select>
            @error('core_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="_descricao">Descrição</label>
        <textarea id="_descricao" class="form-control @error('descricao') is-invalid @enderror" name="descricao" id="_descricao">{{old('descricao', !empty($materiaPrima->descricao) ? $materiaPrima->descricao : '' )}}</textarea>
        @error('descricao')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<button type="submit" class="btn btn-primary">Salvar</button>

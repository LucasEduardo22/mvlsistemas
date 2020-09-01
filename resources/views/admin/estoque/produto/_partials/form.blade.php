<div class="form-body">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="_modelo" class="control-label">Modelo:</label>
                <input value="{{old('modelo', !empty($produto->modelo) ? $produto->modelo : '')}}" type="text" name="modelo" placeholder="modelo" class="form-control col-6 @error('modelo') is-invalid @enderror" id="_modelo" />
                @error('modelo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="_nome_produto" class="control-label">Produto:</label>
                <input value="{{old('nome_produto', !empty($produto->nome_produto) ? $produto->nome_produto : '')}}" type="text" name="nome_produto" placeholder="nome produto" class="form-control col-6 @error('nome_produto') is-invalid @enderror" id="_nome_produto" />
                @error('nome_produto')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="_categoria" class="control-label">Categoria:</label>
                <select id="_categoria" name="categoria_id" class="form-control col-6 @error('categoria_id') is-invalid @enderror">
                    <option>--Select--</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{$categoria->id}}" @if(old('modelo', !empty($produto->categoria->id) ? $produto->categoria->id : '' ) == $categoria->id ) selected="" @endif>{{$categoria->nome}}</option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="_tipo_produto_id" class="control-label">Tipo Produto:</label>
                <select id="_tipo_produto_id" name="tipo_produto_id" class="form-control col-6 @error('tipo_produto_id') is-invalid @enderror">
                    <option>--Select--</option>
                    @foreach ($tipoProdutos as $tipoProduto)
                        <option value="{{$tipoProduto->id}}" @if(old('modelo', !empty($produto->tipoProduto->id) ? $produto->tipoProduto->id : '' ) == $tipoProduto->id ) selected="" @endif>{{$tipoProduto->nome}}</option>
                    @endforeach
                </select>
                @error('tipo_produto_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="_descricao" class="control-label">Descrição:</label>
                <textarea id="_decricao" class="form-control resize_vertical @error('descricao') is-invalid @enderror" name="descricao" id="_descricao" >{{old('descricao', !empty($produto->descricao) ? $produto->descricao : '')}}</textarea>
                @error('decricao')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>
    <button type="submit" name="botao" value="0" class="btn btn-sm btn-info col-2">Salvar</button>
    <button type="submit" name="botao" value="1" class="btn btn-sm btn-primary col-2">Adicionar estoque</button>
</div>
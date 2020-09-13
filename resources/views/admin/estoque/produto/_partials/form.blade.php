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
                <label for="_sub_grupo" class="control-label">SubGrupo:</label>
                <select id="_sub_grupo" name="sub_grupo_id" class="form-control col-6 @error('sub_grupo_id') is-invalid @enderror">
                    <option>--Select--</option>
                    @foreach ($subGrupos as $subGrupo)
                        <option value="{{$subGrupo->id}}" @if(old('sub_grupo_id', !empty($produto->subGrupo->id) ? $produto->subGrupo->id : '' ) == $subGrupo->id ) selected="" @endif>{{$subGrupo->nome}}</option>
                    @endforeach
                </select>
                @error('sub_grupo_id')
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
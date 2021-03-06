<div class="form-body">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="_modelo">Modelo<span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-append">
                        <span class="input-group-text">
                            <i class="fas fa-dolly-flatbed"></i>
                        </span>
                    </span>
                    <input value="{{old('modelo', !empty($produto->modelo) ? $produto->modelo : '')}}" type="text" name="modelo" class="col-sm-5 form-control @error('modelo') is-invalid @enderror" placeholder="Modelo da matéria prima" id="_modelo">
                    @error('modelo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="_nome_produto">Produto<span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-append">
                        <span class="input-group-text">
                            <i class="fab fa-product-hunt"></i>
                        </span>
                    </span>
                    <input value="{{old('nome_produto', !empty($produto->nome_produto) ? $produto->nome_produto : '')}}" type="text" name="nome_produto" class="form-control @error('nome_produto') is-invalid @enderror" placeholder="Produto da matéria prima" id="_nome_produto">
                    @error('nome_produto')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="_tipo_produto_id">Tipo<span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-append">
                        <span class="input-group-text">
                            <i class="fas fa-clipboard-check"></i>
                        </span>
                    </span>
                    <select id="_sub_grupo_id" name="sub_grupo_id" class="col-sm-5 form-control sub_grupo @error('sub_grupo_id') is-invalid @enderror">
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
        <div class="col-sm-6">
            <div class="form-group">
                <label for="_valor_costura">Valor costureira<span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-append">
                        <span class="input-group-text">
                            <i class="fas fa-money-bill-wave"></i>
                        </span>
                    </span>
                    <input value="{{old('valor_costura', !empty($produto->valor_costura) ?  number_format($produto->valor_costura , 2, ',', '.') : '')}}" type="text" name="valor_costura" class="col-sm-5 dinheiro form-control @error('valor_costura') is-invalid @enderror" placeholder="valor_costura da matéria prima" id="_valor_costura">
                    @error('valor_costura')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="_descricao" class="control-label">Descrição:</label>
                <textarea id="_decricao" class="form-control resize_vertical @error('descricao') is-invalid @enderror" name="descricao" id="_descricao" >{{old('descricao', !empty($produto->descricao) ? $produto->descricao : '')}}</textarea>
                @error('descricao')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="_observacao" class="control-label">Observaçao:</label>
                <textarea id="_observacao" class="form-control resize_vertical @error('observacao') is-invalid @enderror" name="observacao" id="_observacao" >{{old('observacao', !empty($produto->observacao) ? $produto->observacao : '')}}</textarea>
                @error('observacao')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <label for="_image" class="control-label">Adicione uma imagem:</label>
            <div class="form-group">
                <label for="_image" class="control-label">
                    @if (!empty($produto->image))
                        <img src="{{ asset('storage/'.$produto->image) }}" alt="{{$produto->image}}" id="_img" style="width: 300px; height: 400px;">
                    @else
                        <img id="_img" style="width: 300px; height: 400px;" src="{{ asset('img/images/mvlsistemas.jpg') }}" alt="mvlsistemas">
                    @endif
                    
                </label>
                <input type="file" name="image" class="@error('image') is-invalid @enderror" {{old('image')}} id="_image" hidden>
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>
   
    <button type="submit" name="botao" value="0" class="btn btn-sm btn-info col-2">Salvar</button>
    <button type="submit" name="botao" value="1" class="btn btn-sm btn-primary col-2">Adicionar Aviamentos</button>
</div>
<div class="form-body">
    <div class="form-group pad-top40">
        <div class="row">
            <label for="_nome" class="col-md-3 control-label">
                Status
            </label>
            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-append">
                        <span class="input-group-text">
                            <i class="fal fa-clipboard-check"></i>
                        </span>
                    </span>
                    <input value="{{old('nome', !empty($status->nome) ? $status->nome : '')}}" type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" placeholder="Nome da Categoria" id="_nome">
                    @error('nome')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label for="_descricao" class="col-md-3 control-label">
                Descrição
            </label>
            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-append">
                        <span class="input-group-text">
                            <i class="far fa-audio-description"></i>
                        </span>
                    </span>
                    <input value="{{old('descricao', !empty($status->descricao) ? $status->descricao : '')}}" type="text" name="descricao" placeholder="Descrição" class="form-control @error('descricao') is-invalid @enderror" id="_descricao"/>
                    @error('descricao')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-position row">
    <div class="col-md-offset-3 col-md-9 ml-auto mb-3">
        <button type="submit" class="btn btn-sm btn-info">Salvar</button>
    </div>
</div>
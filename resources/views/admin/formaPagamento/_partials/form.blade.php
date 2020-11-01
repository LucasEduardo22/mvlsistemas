<div class="form-body">
    <div class="form-group pad-top40">
        <div class="row">
            <label for="_nome" class="col-md-3 control-label">
                Forma Pagamento
            </label>
            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-append">
                        <span class="input-group-text">
                            <i class="fas fa-money-bill-wave-alt"></i>
                        </span>
                    </span>
                    <input value="{{old('nome', !empty($formaPagamento->nome) ? $formaPagamento->nome : '')}}" type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" placeholder="Nome" id="_nome">
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
            <label for="_parcelas" class="col-md-3 control-label">
                Quatidade de Parcelas
            </label>
            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-append">
                        <span class="input-group-text">
                            <i class="fas fa-address-book"></i>
                        </span>
                    </span>
                    <input value="{{old('parcelas', !empty($formaPagamento->parcelas) ? $formaPagamento->parcelas : '')}}" type="text" name="parcelas" placeholder="1, 2" class="form-control @error('parcelas') is-invalid @enderror" id="_parcelas" />
                    @error('parcelas')
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
            <label for="_juros_parcelas" class="col-md-3 control-label">
                Valor do juros sobre a parcelas
            </label>
            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-append">
                        <span class="input-group-text">
                            <i class="fas fa-clipboard-list"></i>
                        </span>
                    </span>
                    <input value="{{old('juros_parcelas', !empty($formaPagamento->juros_parcelas) ? $formaPagamento->juros_parcelas : '')}}" type="text" name="juros_parcelas" placeholder="%%" class="form-control @error('juros_parcelas') is-invalid @enderror" id="_juros_parcelas"/>
                    @error('juros_parcelas')
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
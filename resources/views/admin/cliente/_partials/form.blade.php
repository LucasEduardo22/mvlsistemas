<div class="form-row">
    <div class="form-group col-md-1">
        <div class="form-check">
            <input class="form-check-input cpf-cnpj" type="radio" name="cnpj_cpf" id="gridRadios2"
                value="cnpj" checked="">
            
            <label class="form-check-label cpf-cnpj" for="gridRadios2">
                CNPJ
            </label>
        </div>
    </div>
    <div class="form-group col-md-1">
        <div class="form-check">
            <input class="form-check-input cpf-cnpj" type="radio" name="cnpj_cpf" id="gridRadios1"
                value="cpf">
            <label class="form-check-label" for="gridRadios1">
                CPF
            </label>
        </div>
    </div>
</div> 
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="_nome">Nome / Fantasia</label>
        <input type="text" name="nome" class="form-control text_maiusculo @error('nome') is-invalid @enderror" id="_nome" value="{{old('nome', !empty($cliente->nome) ? $cliente->nome : '')}}" placeholder="Nome / fantasia">
        @error('nome')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
        <div class="form-group col-md-6">
        <label for="_razao_social">Razão Social</label>
        <input type="text" name="razao_social" class="form-control text_maiusculo  @error('razao_social') is-invalid @enderror" id="_razao_social" value="{{old('razao_social', !empty($cliente->razao_social) ? $cliente->razao_social : '')}}" placeholder="Razão social">
        @error('razao_social')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="_email">E-mail</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email', !empty($cliente->email) ? $cliente->email : '')}}" id="_email" placeholder="E-mail">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="_classificacao">Classificação</label>
        <input type="text" name="classificacao" class="form-control text_maiusculo @error('classificacao') is-invalid @enderror" value="{{old('classificacao', !empty($cliente->classificacao) ? $cliente->classificacao : '')}}" id="_classificacao">
        @error('classificacao')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    {{-- <div class="form-group col-md-6">
        <label for="_contato_principal">Nome do Responsável</label>
        <input type="contato_principal" name="contato_principal" class="form-control @error('contato_principal') is-invalid @enderror" value="{{old('contato_principal', !empty($cliente->contato_principal) ? $cliente->contato_principal : '')}}" id="_contato_principal" placeholder="Nome e e-mail ou telefone">
        @error('contato_principal')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div> --}}
</div>

<div class="form-row">
    <div class="form-group col-md-3 mb-3">
        <label for="_cpf_cnpj" id="label-cpf_cnpj">CNPJ</label>
        <input type="text" name="cpf_cnpj" class="form-control @error('cpf_cnpj') is-invalid @enderror" id="_cpf_cnpj" value="{{old('cpf_cnpj', !empty($cliente->cpf_cnpj) ? $cliente->cpf_cnpj : '')}}" placeholder="99.999.999/9999-99">
        @error('cpf_cnpj')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-3 mb-3">
        <label for="_celular">Celular</label>
        <input type="text" name="celular" class="form-control @error('celular') is-invalid @enderror" id="_celular" value="{{old('celular', !empty($cliente->celular) ? $cliente->celular : '')}}" placeholder="(99) 9 9999-9999">
        @error('celular')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-3 mb-3">
        <label for="_telefone">Telefone</label>
        <input type="text" name="telefone" class="form-control @error('telefone') is-invalid @enderror" id="_telefone" value="{{old('telefone', !empty($cliente->telefone) ? $cliente->telefone : '')}}" placeholder="(99) 9999-9999">
        @error('telefone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-3 mb-3">
        <label for="_ie">IE</label>
        <input type="text" name="ie" class="form-control text_maiusculo @error('ie') is-invalid @enderror" id="_ie" value="{{old('ie', !empty($cliente->ie) ? $cliente->ie : '')}}" placeholder="999.99999-99">
        @error('ie')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-3 mb-3">
        <label for="_cep">CEP</label>
        <input type="text" name="cep" class="form-control @error('cep') is-invalid @enderror" id="_cep" value="{{old('cep', !empty($cliente->cep) ? $cliente->cep : '')}}" placeholder="99999-999">
        @error('cep')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-4">
        <label for="_estado">Estado</label>
        <input type="text" name="estado" class="form-control text_maiusculo @error('estado') is-invalid @enderror" value="{{old('estado', !empty($cliente->estado) ? $cliente->estado : '')}}" id="_estado">
        @error('estado')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-4">
        <label for="_cidade">Cidade</label>
        <input type="text" name="cidade" class="form-control text_maiusculo @error('cidade') is-invalid @enderror" value="{{old('cidade', !empty($cliente->cidade) ? $cliente->cidade : '')}}" id="_cidade">
        @error('cidade')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-4">
        <label for="_bairro">Bairro</label>
        <input type="text" name="bairro" class="form-control text_maiusculo @error('bairro') is-invalid @enderror" value="{{old('bairro', !empty($cliente->bairro) ? $cliente->bairro : '')}}" id="_bairro">
        @error('bairro')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="_endereco">Endereço</label>
        <input type="text" name="endereco" class="form-control text_maiusculo @error('endereco') is-invalid @enderror" value="{{old('endereco', !empty($cliente->endereco) ? $cliente->endereco : '')}}" id="_endereco">
        @error('endereco')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-3">
        <label for="_numero">Número</label>
        <input type="text" name="numero" class="form-control @error('numero') is-invalid @enderror" value="{{old('numero', !empty($cliente->numero) ? $cliente->numero : '')}}" id="_numero">
        @error('numero')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-3">
        <label for="_complemento">Complemento</label>
        <input type="text" name="complemento" class="form-control text_maiusculo @error('complemento') is-invalid @enderror" value="{{old('complemento', !empty($cliente->complemento) ? $cliente->complemento : '')}}" id="_complemento">
        @error('complemento')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    
</div>
<button type="submit" class="btn btn-primary">Salvar</button>

@include('includes.alert')
@if (empty($cliente))
    <form action="{{route('cliente.store')}}" method="post">
    @method('POST')
@else
   <form action="{{route('cliente.update', $cliente->id)}}" method="post">
    @method('PUT')
@endif
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="_nome_cliente">Nome Cliente</label>
            <input type="text" name="nome_cliente" class="form-control @error('nome_cliente') is-invalid @enderror" id="_nome_cliente" value="{{old('nome_cliente', !empty($cliente->nome_cliente) ? $cliente->nome_cliente : '')}}" placeholder="Nome Cliente">
            @error('nome_cliente')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
         <div class="form-group col-md-6">
            <label for="_razao_social">Razão Social</label>
            <input type="text" name="razao_social" class="form-control  @error('razao_social') is-invalid @enderror" id="_razao_social" value="{{old('razao_social', !empty($cliente->razao_social) ? $cliente->razao_social : '')}}" placeholder="Razão social">
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
            <label for="_nome_responsavel">Nome do Responsável</label>
            <input type="nome_responsavel" name="nome_responsavel" class="form-control @error('nome_responsavel') is-invalid @enderror" value="{{old('nome_responsavel', !empty($cliente->nome_responsavel) ? $cliente->nome_responsavel : '')}}" id="_nome_responsavel" placeholder="Nome do responsável">
            @error('nome_responsavel')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group col-md-3 mb-3">
            <label for="_cnpj">CNPJ</label>
            <input type="text" name="cnpj" class="form-control @error('cnpj') is-invalid @enderror" id="_cnpj" value="{{old('cnpj', !empty($cliente->cnpj) ? $cliente->cnpj : '')}}" placeholder="99.999.999/0000-00">
            @error('cnpj')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-3 mb-3">
            <label for="_telefone">Telefone</label>
            <input type="text" name="telefone" class="form-control @error('telefone') is-invalid @enderror" id="_telefone" value="{{old('telefone', !empty($cliente->telefone) ? $cliente->telefone : '')}}" placeholder="(99) 9 9999-9999">
        </div>
        <div class="form-group col-md-3 mb-3">
            <label for="_inscricao_estadual">IE</label>
            <input type="text" name="inscricao_estadual" class="form-control @error('inscricao_estadual') is-invalid @enderror" id="_inscricao_estadual" value="{{old('inscricao_estadual', !empty($cliente->inscricao_estadual) ? $cliente->inscricao_estadual : '')}}" placeholder="9999999-99">
            @error('inscricao_estadual')
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
            <input type="text" name="estado" class="form-control @error('estado') is-invalid @enderror" value="{{old('estado', !empty($cliente->estado) ? $cliente->estado : '')}}" id="_estado">
            @error('estado')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label for="_cidade">Cidade</label>
            <input type="text" name="cidade" class="form-control @error('cidade') is-invalid @enderror" value="{{old('cidade', !empty($cliente->cidade) ? $cliente->cidade : '')}}" id="_cidade">
            @error('cidade')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label for="_bairro">Bairro</label>
            <input type="text" name="bairro" class="form-control @error('bairro') is-invalid @enderror" value="{{old('bairro', !empty($cliente->bairro) ? $cliente->bairro : '')}}" id="_bairro">
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
            <input type="text" name="endereco" class="form-control @error('endereco') is-invalid @enderror" value="{{old('endereco', !empty($cliente->endereco) ? $cliente->endereco : '')}}" id="_endereco">
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
            <input type="text" name="complemento" class="form-control @error('complemento') is-invalid @enderror" value="{{old('complemento', !empty($cliente->complemento) ? $cliente->complemento : '')}}" id="_complemento">
            @error('complemento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="_classificacao">Classificação</label>
            <input type="text" name="classificacao" class="form-control @error('classificacao') is-invalid @enderror" value="{{old('classificacao', !empty($cliente->classificacao) ? $cliente->classificacao : '')}}" id="_classificacao">
            @error('classificacao')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
@include('includes.alert')
{{-- @if (empty($fornecedor))
    <form action="{{route('fornecedor.store')}}" method="post">
    @method('POST')
@else
   <form action="{{route('fornecedor.update', $fornecedor->id)}}" method="post">
    @method('PUT')
@endif --}}
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="_nome">Nome do Fornecedor</label>
            <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" id="_nome" value="{{old('nome', !empty($fornecedor->nome) ? $fornecedor->nome : '')}}" placeholder="Nome do Fornecedor">
            @error('nome_fornecedor')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
         <div class="form-group col-md-6">
            <label for="_razao_social">Razão Social</label>
            <input type="text" name="razao_social" class="form-control  @error('razao_social') is-invalid @enderror" id="_razao_social" value="{{old('razao_social', !empty($fornecedor->razao_social) ? $fornecedor->razao_social : '')}}" placeholder="Razão social">
            @error('razao_social')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="_email">E-mail</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email', !empty($fornecedor->email) ? $fornecedor->email : '')}}" id="_email" placeholder="E-mail">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        {{-- <div class="form-group col-md-6">
            <label for="_nome_responsavel">Nome do Responsável</label>
            <input type="nome_responsavel" name="nome_responsavel" class="form-control @error('nome_responsavel') is-invalid @enderror" value="{{old('nome_responsavel', !empty($fornecedor->nome_responsavel) ? $fornecedor->nome_responsavel : '')}}" id="_nome_responsavel" placeholder="Nome do responsável">
            @error('nome_responsavel')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div> --}}
    </div>
    
    <div class="form-row">
        <div class="form-group col-md-3 mb-3">
            <label for="_cnpj">CNPJ</label>
            <input type="text" name="cnpj" class="form-control @error('cnpj') is-invalid @enderror" id="_cnpj" value="{{old('cnpj', !empty($fornecedor->cnpj) ? $fornecedor->cnpj : '')}}" placeholder="99.999.999/0000-00">
            @error('cnpj')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-3 mb-3">
            <label for="_inscricao_estadual">IE</label>
            <input type="text" name="inscricao_estadual" class="form-control @error('inscricao_estadual') is-invalid @enderror" id="_inscricao_estadual" value="{{old('inscricao_estadual', !empty($fornecedor->inscricao_estadual) ? $fornecedor->inscricao_estadual : '')}}" placeholder="9999999-99">
            @error('inscricao_estadual')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-3 mb-3">
            <label for="_telefone">Telefone</label>
            <input type="text" name="telefone" class="form-control @error('telefone') is-invalid @enderror" id="_telefone" value="{{old('telefone', !empty($fornecedor->telefone) ? $fornecedor->telefone : '')}}" placeholder="(99) 9 9999-9999">
        </div>
        <div class="form-group col-md-3 mb-3">
            <label for="_celular">Celular</label>
            <input type="text" name="celular" class="form-control @error('celular') is-invalid @enderror" id="_celular" value="{{old('celular', !empty($fornecedor->celular) ? $fornecedor->celular : '')}}" placeholder="(99) 9 9999-9999">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3 mb-3">
            <label for="_cep">CEP</label>
            <input type="text" name="cep" class="form-control @error('cep') is-invalid @enderror" id="_cep" value="{{old('cep', !empty($fornecedor->cep) ? $fornecedor->cep : '')}}" placeholder="99999-999">
            @error('cep')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="_estado">Estado</label>
            <input type="text" name="estado" class="form-control @error('estado') is-invalid @enderror" value="{{old('estado', !empty($fornecedor->estado) ? $fornecedor->estado : '')}}" id="_estado">
            @error('estado')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="_cidade">Cidade</label>
            <input type="text" name="cidade" class="form-control @error('cidade') is-invalid @enderror" value="{{old('cidade', !empty($fornecedor->cidade) ? $fornecedor->cidade : '')}}" id="_cidade">
            @error('cidade')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="_bairro">Bairro</label>
            <input type="text" name="bairro" class="form-control @error('bairro') is-invalid @enderror" value="{{old('bairro', !empty($fornecedor->bairro) ? $fornecedor->bairro : '')}}" id="_bairro">
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
            <input type="text" name="endereco" class="form-control @error('endereco') is-invalid @enderror" value="{{old('endereco', !empty($fornecedor->endereco) ? $fornecedor->endereco : '')}}" id="_endereco">
            @error('endereco')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="_numero">Número</label>
            <input type="text" name="numero" class="form-control @error('numero') is-invalid @enderror" value="{{old('numero', !empty($fornecedor->numero) ? $fornecedor->numero : '')}}" id="_numero">
            @error('numero')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="_complemento">Complemento</label>
            <input type="text" name="complemento" class="form-control @error('complemento') is-invalid @enderror" value="{{old('complemento', !empty($fornecedor->complemento) ? $fornecedor->complemento : '')}}" id="_complemento">
            @error('complemento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        {{-- <div class="form-group col-md-3">
            <label for="_classificacao">Classificação</label>
            <input type="text" name="classificacao" class="form-control @error('classificacao') is-invalid @enderror" value="{{old('classificacao', !empty($fornecedor->classificacao) ? $fornecedor->classificacao : '')}}" id="_classificacao">
            @error('classificacao')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div> --}}
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
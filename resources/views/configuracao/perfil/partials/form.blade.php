@include('includes.alert')
@csrf
<div class="form-group">
    <label for="_nome">Perfil</label>
    <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{old('nome', !empty($perfil->nome) ? $perfil->nome : '')}}" id="_nome">
    @error('nome')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="_descricao">Descrição</label>
    <input type="text" name="descricao" class="form-control @error('descricao') is-invalid @enderror" value="{{old('descricao', !empty($perfil->descricao) ? $perfil->descricao : '')}}" id="_descricao">
    @error('descricao')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<button type="submit" class="btn btn-primary">Salvar</button>

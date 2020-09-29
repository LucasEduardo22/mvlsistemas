<div class="form-row">
    <div class="form-group col-md-6">
        <label for="_name">Nome</label>
        <input type="text" name="name" class="form-control text_maiusculo @error('name') is-invalid @enderror" id="_nome" value="{{old('name', !empty($usuario->name) ? $usuario->name : '')}}" placeholder="Nome do Usuário">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="_email">E-mail</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email', !empty($usuario->email) ? $usuario->email : '')}}" id="_email" placeholder="E-mail">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="_perfil" class="control-label">perfil:</label>
        <select id="_perfil" name="perfil_id" class="form-control col-6 @error('perfil_id') is-invalid @enderror">
            <option>--Select--</option>
            @foreach ($perfils as $perfil)
                <option value="{{$perfil->id}}" @if(old('perfil_id', !empty($produto->perfil->id) ? $produto->perfil->id : '' ) == $perfil->id ) selected="" @endif>{{$perfil->nome}}</option>
            @endforeach
        </select>
        @error('perfil_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<button type="submit" class="btn btn-primary">Salvar</button>

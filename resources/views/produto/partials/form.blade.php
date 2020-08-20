@include('includes.alert')
@if (empty($produto))
    <form action="{{route('produto.store')}}" method="post">
    @method('POST')
@else
    <form action="{{route('produto.update', $produto->id)}}" method="post">
    @method('PUT')
@endif
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="_produto">Produto</label>
            <input type="text" name="nome" value = "{{old('nome', !empty($produto->nome) ? $produto->nome : '')}}" class="form-control @error('nome') is-invalid @enderror" id="_produto" placeholder="Nome do Produto">
            @if($errors->has('nome'))
                <div class="invalid-feedback"> {{$errors->first('nome')}}</div>
            @endif
        </div>
    
        <div class="form-group col-md-6">
            <label for="_codigo_referencia">Codigo de referencia</label>
            <input type="text" name="codigo_referencia"value = "{{old('codigo_referencia', !empty($produto->codigo_referencia) ? $produto->codigo_referencia : '')}}" class="form-control @error('codigo_referencia') is-invalid @enderror" id="_codigo_referencia" placeholder="Codigo de referência">
            @if($errors->has('codigo_referencia'))
                <div class="invalid-feedback"> {{$errors->first('codigo_referencia')}}</div>
            @endif
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="_unidade">unidade</label>
            <select id="_unidade" name="unidade_id" class="form-control @error('unidade_id') is-invalid @enderror">
                <option value = "">Selecione o tipo de unidade</option>
                @foreach ($unidades as $unidade)
                    <option value="{{$unidade->id}}"  @if(old('unidade_id', !empty($produto->unidade->id) ? $produto->unidade->id : "") == $unidade->id) selected="" @endif >{{$unidade->nome}} - {{$unidade->descricao}}</option>
                @endforeach
            </select>
            @if($errors->has('unidade_id'))
                <div class="invalid-feedback"> {{$errors->first('unidade_id')}}</div>
            @endif
        </div>
        <div class="form-group col-md-3">
            <label for="_tipo_produto">Tipo do produto</label>
            <select id="_tipo_produto" name="tipoproduto_id" class="form-control @error('tipoproduto_id') is-invalid @enderror">
                <option value = "">Selecione o tipo do produto</option>
                @foreach ($tipoprodutos as $tipoproduto)
                    <option value="{{$tipoproduto->id}}" @if(old('tipoproduto_id', !empty($produto->tipoProduto->id) ? $produto->tipoProduto->id : "") == $tipoproduto->id) selected="" @endif >
                        {{$tipoproduto->nome}} - {{$tipoproduto->descricao}}
                    </option>
                @endforeach
            </select>
            @if($errors->has('tipoproduto_id'))
                <div class="invalid-feedback"> {{$errors->first('tipoproduto_id')}}</div>
            @endif
        </div>
        <div class="form-group col-md-3">
            <label for="_tamanho">tamanho</label>
            <select id="_tamanho" name="tamanho_id" class="form-control @error('tamanho_id') is-invalid @enderror">
                <option value = "">Selecione o tamanho</option>
                @foreach ($tamanhos as $tamanho)
                    <option value="{{$tamanho->id}}"  @if(old('tamanho_id', !empty($produto->tamanho->id) ? $produto->tamanho->id : "") == $tamanho->id) selected="" @endif>
                        {{$tamanho->nome}} - {{$tamanho->descricao}}
                    </option>
                @endforeach
            </select>
            @if($errors->has('tamanho_id'))
                <div class="invalid-feedback"> {{$errors->first('tamanho_id')}}</div>
            @endif
        </div>
        
        <div class="form-group col-md-3">
            <label for="_categoria_id">categoria</label>
            <select id="_categoria_id" name="categoria_id" class="form-control @error('categoria_id') is-invalid @enderror">
                <option value="0">Selecione a categoria</option>
                @foreach ($categorias as $categoria)
                    <option value="{{$categoria->id}}"  @if(old('categoria_id', !empty($produto->categoria->id) ? $produto->categoria->id : "") == $categoria->id) selected="" @endif>
                        {{$categoria->nome}}
                    </option>
                @endforeach
            </select>
            @if($errors->has('categoria_id'))
                <div class="invalid-feedback"> {{$errors->first('categoria_id')}}</div>
            @endif
        </div>
    </div>
    <button type="submit" name="botao0" class="btn btn-primary" value="0">Salvar Produto </button>
    <button type="submit" name="botao1" class="btn btn-primary" value="1">Ficha Técnica </button>
</form>
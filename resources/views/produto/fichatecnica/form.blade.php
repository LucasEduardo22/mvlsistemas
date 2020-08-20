@include('includes.alert')   {{--Edição da ficha Técnica--}}
@csrf
<div class="form-row">
    {{--DESCRIÇÃO--}}
    <div class="form-row col-md-8"> 
        <div class="form-group col-md-12">
            <label for="_descricao">Descrição</label>
            <input type="text" name="descricao"value = "{{old('descricao', !empty($produto->fichaTecnica->descricao) ? $produto->fichaTecnica->descricao : '')}}" class="form-control @error('descricao') is-invalid @enderror" id="_descricao" placeholder="Descrição">
            @if($errors->has('descricao'))
                <div class="invalid-feedback"> {{$errors->first('descricao')}}</div>
            @endif
        </div>
        {{--AVIAMENTO--}}
        <div class="form-group col-md-12">
            <label for="aviamento">Aviamento</label>
            <textarea class="form-control" name="aviamento" id="aviamento" rows="3">{{old('descricao', !empty($produto->fichaTecnica->aviamento) ? $produto->fichaTecnica->aviamento : '')}}</textarea>    
            @if($errors->has('aviamento'))
                <div class="invalid-feedback"> {{$errors->first('aviamento')}}</div>
            @endif
        </div>
       {{--OBESERVAÇÃO--}}
        <div class="form-group col-md-12"> 
            <label for="observacao">Observação</label>
            <textarea class="form-control"   name="observacao" id="observacao" rows="3">{{old('descricao', !empty($produto->fichaTecnica->observacao) ? $produto->fichaTecnica->observacao : '')}}</textarea>   
            @if($errors->has('observacao'))
                <div class="invalid-feedback"> {{$errors->first('observacao')}}</div>
            @endif
        </div>
    </div> 
     {{--IMAGEM--}}
    <div class="form-row col-md-4">
        <div class="card" style="width: 20rem;">
            <label for="_image">
                <img class="card-img-top" name="image" src="{{ asset('assets/images/roupa.png')}}" alt="Card image cap">
            </label>
            <div class="card-body d-none">
                <input type="file" name="image" id="_image">
            </div>
            @if($errors->has('image'))
                <div class="invalid-feedback"> {{$errors->first('image')}}</div>
            @endif
        </div>
    </div>
</div>
<button type="submit" class="btn btn-primary">Salvar Ficha Técnica</button>
   
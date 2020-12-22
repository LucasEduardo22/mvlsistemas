<div class="form-body">
    <h3>Dados do Produto</h3>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Código modelo:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$produto->modelo}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Produto:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$produto->nome_produto}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Tipo de produto:</label>
                    <div class="col-sm-8">
                        {{-- <p class="form-control-static"><strong>{{$produto->tipoProduto->nome}}</strong></p> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">SubGrupo:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$produto->subGrupo->nome}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Descrição:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{!$produto->descricao ? "Não informado": $produto->descricao}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <h3>Aviamento</h3>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <table id="people-table" class="col-md-12 table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="border-top-0" scope="col">#</th>
                            <th class="border-top-0" scope="col">Aviamento</th>
                            <th class="border-top-0" scope="col">Preço custo</th>
                            <th class="border-top-0" scope="col">Quantidade</th>
                            <th class="border-top-0" scope="col">Adicione detalhes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($materiaPrimas as $materiaPrima)
                            @php
                                $dados = $produto->materiaPrimas()->where('materia_prima_id', $materiaPrima->id)->first();
                            @endphp
                            <tr>
                                <td>
                                    @if (!empty($dados))
                                        @if ($materiaPrima->id == $dados->materia_prima_id)
                                            <strong class="txtChecked"><i class="fas fa-check-circle"></i></strong>    
                                        @else
                                            <input type="checkbox" name="materia_prima_id[]" id="" value="{{$materiaPrima->id}}">
                                        @endif
                                    @else
                                        <input class="_ave" type="checkbox" name="materia_prima_id[]" id="" value="{{$materiaPrima->id}}">
                                    @endif
                                    
                                </td>
                                <td>
                                    {{$materiaPrima->nome}}
                                </td>
                                <td>
                                    {{!empty($materiaPrima->preco_compra) ? "R$". number_format($materiaPrima->preco_compra , 2, ',', '.') : "não informado"}}
                                </td>
                                <td>
                                    @if (!empty($dados))
                                        @if ($materiaPrima->id == $dados->materia_prima_id)
                                            <input value="{{old('quantidade', !empty($dados->quantidade) ? $dados->quantidade : '')}}" type="text" name="quantidadeT[]" class="only-number form-control @error('quantidade') is-invalid @enderror" placeholder="Quantidade" id="_quantidade" data-accept-dot="1" data-accept-comma="1">
                                            @error('quantidade')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror    
                                        @else
                                            <input value="{{old('quantidade', !empty($dados->quantidade) ? $dados->quantidade : '')}}" type="text" name="quantidade[]" class="only-number form-control @error('quantidade') is-invalid @enderror" placeholder="Quantidade" id="_quantidade" data-accept-dot="1" data-accept-comma="1">
                                            @error('quantidade')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror   
                                        @endif
                                    @else
                                        <input value="{{old('quantidade', !empty($dados->quantidade) ? $dados->quantidade : '')}}" type="text" name="quantidade[]" class="only-number form-control @error('quantidade') is-invalid @enderror" placeholder="Quantidade" id="_quantidade" data-accept-dot="1" data-accept-comma="1">
                                        @error('quantidade')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror 
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($dados))
                                        @if ($materiaPrima->id == $dados->materia_prima_id)
                                            <textarea id="_detalhes" class="form-control _detalhes resize_vertical @error('detalhes') is-invalid @enderror" name="detalhe[]" id="_detalhes" >{{old('detalhes', !empty($dados->detalhes) ? $dados->detalhes : '')}}</textarea>
                                            <input type="hidden" name="Ave_id[]" value="{{$dados->id}}">
                                            @error('detalhes')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror    
                                        @else
                                            <textarea id="_detalhes" class="form-control resize_vertical @error('detalhes') is-invalid @enderror" name="detalhes[]" id="_detalhes" >{{old('detalhes', !empty($dados->detalhes) ? $dados->detalhes : '')}}</textarea>
                                            <input type="hidden" name="materiaPrima[]" value="{{$materiaPrima->id}}">
                                            @error('detalhes')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        @endif
                                    @else
                                        <input type="hidden" name="" class="">
                                        <textarea id="_detalhes" class="form-control resize_vertical @error('detalhes') is-invalid @enderror" name="detalhes[]" id="_detalhes" >{{old('detalhes', !empty($dados->detalhes) ? $dados->detalhes : '')}}</textarea>
                                        <input type="hidden" name="materiaPrima[]" value="{{$materiaPrima->id}}">
                                        @error('detalhes')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @endif
                                    
                                </td>
                            </tr>
                        @endforeach                                            
                    </tbody>
                </table>
                <div class="card-footer">
                    @if (isset($filtros))
                        {!!$materiaPrimas->appends($filtros)->links()!!}
                    @else
                        {!!$materiaPrimas->links()!!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<button type="submit" name="botao" value="0" class="btn btn-sm btn-info col-2">Salvar</button>
<button type="submit" name="botao" value="1" class="btn btn-sm btn-primary col-2">Adicionar Estoque</button>
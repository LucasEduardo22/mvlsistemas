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
                            <th class="border-top-0" scope="col">Adicione detalhes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aviamentos as $aviamento)
                            @php
                                $dados = $produto->aviamentos()->where('aviamento_id', $aviamento->id)->first(); 
                            @endphp
                            <tr>
                                <td>
                                    @if (!empty($dados))
                                        @if ($aviamento->id == $dados->aviamento_id)
                                            <strong class="txtChecked"><i class="fas fa-check-circle"></i></strong>    
                                        @else
                                            <input type="checkbox" name="aviamento_id[]" id="" value="{{$aviamento->id}}">
                                        @endif
                                    @else
                                        <input type="checkbox" name="aviamento_id[]" id="" value="{{$aviamento->id}}">
                                    @endif
                                    
                                </td>
                                <td>
                                    {{$aviamento->nome}}
                                </td>
                                <td>
                                    @if (!empty($dados))
                                        @if ($aviamento->id == $dados->aviamento_id)
                                            <textarea id="_detalhes" class="form-control resize_vertical @error('detalhes') is-invalid @enderror" name="detalhe[]" id="_detalhes" >{{old('detalhes', !empty($dados->detalhes) ? $dados->detalhes : '')}}</textarea>
                                            <input type="hidden" name="id[]" value="{{$dados->id}}">
                                            @error('detalhes')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror    
                                        @else
                                            <textarea id="_detalhes" class="form-control resize_vertical @error('detalhes') is-invalid @enderror" name="detalhes[]" id="_detalhes" >{{old('detalhes', !empty($dados->detalhes) ? $dados->detalhes : '')}}</textarea>
                                            @error('detalhes')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        @endif
                                    @else
                                        <textarea id="_detalhes" class="form-control resize_vertical @error('detalhes') is-invalid @enderror" name="detalhes[]" id="_detalhes" >{{old('detalhes', !empty($dados->detalhes) ? $dados->detalhes : '')}}</textarea>
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
                        {!!$aviamentos->appends($filtros)->links()!!}
                    @else
                        {!!$aviamentos->links()!!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<button type="submit" name="botao" value="1" class="float-right btn btn-info col-2">Salvar</button>
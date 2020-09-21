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
                            <th class="border-top-0" scope="col">Codigo</th>
                            <th class="border-top-0" scope="col">Aviamento</th>
                            <th class="border-top-0" scope="col">Adicione detalhes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aviamentos as $aviamento)
                            <tr>
                                <td>
                                    <input type="checkbox" name="aviamento_id[]" id="" value="{{$aviamento->id}}">
                                </td>
                                <td>
                                    {{$aviamento->id}}
                                </td>
                                <td>
                                    {{$aviamento->nome}}
                                </td>
                                <td>
                                    <textarea id="_detalhes" class="form-control resize_vertical @error('detalhes') is-invalid @enderror" name="detalhes[]" id="_detalhes" >{{old('detalhes')}}</textarea>
                                    @error('detalhes')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
<div class="form-body">
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="_image" class="control-label">
                    @if (!empty($produto->image))
                        <img src="{{ asset('storage/'.$produto->image) }}" alt="{{$produto->image}}" id="_img" style="width: 350px; height: 450px;">
                    @else
                        <img id="_img" style="width: 300px; height: 400px;" src="{{ asset('img/images/mvlsistemas.jpg') }}" alt="mvlsistemas">
                    @endif
                </label>
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
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Modelo:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$produto->modelo}}</strong></p>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 control-label">Sub Grupo:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$produto->subGrupo->nome}}</strong></p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Descrição:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$produto->descricao}}</strong></p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Observção:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$produto->observacao}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Email:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$produto->email}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">CNPJ:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static" id="cpf_cnpj"><strong>{{$produto->cpf_cnpj}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">I.E:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static" id="ie"><strong>{{$produto->ie}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Telefone:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static" id="telefone"><strong>{{$produto->telefone}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Celular:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static" id="celular"><strong>{{$produto->celular}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h3>Endereço</h3>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Endereço:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$produto->endereco}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Nº:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$produto->numero}}</strong></p>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Estado:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$produto->estado}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Cidade:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$produto->cidade}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="row"> <label class="col-sm-4 control-label">CEP:</label>
                <div class="col-sm-8">
                    <p class="form-control-static" id="cep"><strong>{{$produto->cep}}</strong></p>
                </div>
            </div>
        </div>
    </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Complemento:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$produto->complemento}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>